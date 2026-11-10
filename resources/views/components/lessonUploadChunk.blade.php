{{-- This file is used at: course_management.blade.php & lessonEdit.blade.php files --}}

<script>
    function discardUploadedVideo() {
        if (!window.newVideoUploadedThisSession) return;

        const videoPath = $('#videoPath').val();
        const lessonUID = $('#lessonUID').val();
        const courseUID = $('.courseDropdown option:selected').data('course_uid');

        if (!lessonUID || !courseUID) return;

        $('#videoPath').val('');
        $('#lessonUID').val('');
        window.newVideoUploadedThisSession = false;

        navigator.sendBeacon(
            '{{ route('lesson.discard.video') }}',
            new URLSearchParams({
                _token: '{{ csrf_token() }}',
                course_uid: courseUID,
                lesson_uid: lessonUID,
					 flag: $('input[name="flag"]').val() || 'create',
            })
        );
    }

    $(document).ready(function() {

        let isUploadingVideo = false;
        window.newVideoUploadedThisSession = false;

        // -------------------- DROPIFY REMOVE BLOCK --------------------
        const videoDropify = $('#videoInput').dropify();
        videoDropify.on('dropify.afterClear', function(event, element) {
            // $('#remove_video').val(1);
            // $('#videoPath').val('');
            if (window.newVideoUploadedThisSession) {
                discardUploadedVideo();
            }
            $('#remove_video').val(1);
            $('#videoPath').val('');
        });
        videoDropify.on('dropify.change', function() {
            $('#remove_video').val(0);
            window.newVideoUploadedThisSession = false;
        });
        // -------------------- DROPIFY REMOVE BLOCK --------------------


        // -------------- Helper to update the progress bar UI --------------
        function setProgress(percent, statusMsg) {
            $('#videoUploadProgressWrapper').show();
            $('#videoUploadProgressBar').css('width', percent + '%');
            $('#videoUploadPercent').text(percent + '%');
            if (statusMsg !== undefined) {
                $('#videoUploadStatusMsg').text(statusMsg);
                if (percent >= 100) {
                    $('#videoUploadStatusMsg').css('color', '#22c55e');
                    $('#videoUploadPercent').css('color', '#22c55e');
                    $('#videoUploadProgressBar').css('background', '#22c55e');
                } else {
                    $('#videoUploadStatusMsg').css('color', '#9ca3af');
                    $('#videoUploadPercent').css('color', '#6b7280');
                    $('#videoUploadProgressBar').css('background', '#3b82f6');
                }
            }
        }

        // -------------- Helper to hide and reset progress bar --------------

        function resetProgress() {
            $('#videoUploadProgressWrapper').hide();
            $('#videoUploadProgressBar').css('width', '0%');
            $('#videoUploadPercent').text('0%');
            $('#videoUploadStatusMsg').text('');
        }

        $('#videoInput').on('change', async function() {
            const file = this.files[0];
            if (!file) return;

            const selectedCourse = $('.courseDropdown option:selected');
            const courseUID = selectedCourse.data('course_uid');
            if (!courseUID) {
                alert('Please select a course first.');
                $(this).val('');
                return;
            }

            const title = $('#lessonTitle').val().trim();
            if (!title) {
                alert('Please enter the lesson title first before uploading a video.');
                $(this).val('');
                return;
            }

            let lessonUID = $('#lessonUID').val();
            if (!lessonUID) {
                try {
                    const uidResponse = await fetch('{{ route('lesson.generate.uid') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            title: title
                        }),
                    });
                    const uidResult = await uidResponse.json();
                    if (!uidResponse.ok || !uidResult.status || !uidResult.lesson_uid) {
                        throw new Error('Failed to generate lesson UID.');
                    }
                    lessonUID = uidResult.lesson_uid;
                    $('#lessonUID').val(lessonUID);
                } catch (error) {
                    alert(error.message);
                    return;
                }
            }

            isUploadingVideo = true;
            resetProgress();

            const chunkSize = 5 * 1024 * 1024;
            const totalChunks = Math.ceil(file.size / chunkSize);
            const fileName = Date.now() + '_' + file.name;
            let sanitizedFileName = fileName;

            try {
                for (let i = 0; i < totalChunks; i++) {
                    const start = i * chunkSize;
                    const end = Math.min(start + chunkSize, file.size);
                    const chunk = file.slice(start, end);

                    let formData = new FormData();
                    formData.append('chunk', chunk);
                    formData.append('chunk_index', i);
                    formData.append('file_name', sanitizedFileName);

                    // AbortController so a hung request throws after 60s instead of silently hanging and freezing isUploadingVideo=true
                    const controller = new AbortController();
                    const timeout = setTimeout(() => controller.abort(), 60000);

                    let upload;
                    try {
                        upload = await fetch('{{ route('lesson.upload.chunk') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData,
                            signal: controller.signal,
                        });
                    } finally {
                        clearTimeout(timeout);
                    }

                    let uploadResult = await upload.json();
                    if (!upload.ok || !uploadResult.status) {
                        throw new Error(uploadResult.message || 'Chunk upload failed.');
                    }

                    if (i === 0 && uploadResult.file_name) {
                        sanitizedFileName = uploadResult.file_name;
                    }

                    // -------------- Updating progress after each chunk --------------
                    const percentDone = Math.round(((i + 1) / totalChunks) *
                        90); // 90% for upload phase
                    setProgress(percentDone, `Uploading chunk ${i + 1} of ${totalChunks}...`);
                }

                setProgress(95, 'Merging chunks on server...');

                const mergeController = new AbortController();
                const mergeTimeout = setTimeout(() => mergeController.abort(), 120000);

                let merge;
                try {
                    merge = await fetch('{{ route('lesson.merge.chunk') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            file_name: sanitizedFileName,
                            total_chunks: totalChunks,
                            course_uid: courseUID,
                            lesson_uid: lessonUID, flag: $('input[name="flag"]').val() ?? 'create',
                        }),
                        signal: mergeController
                            .signal,
                    });
                } finally {
                    clearTimeout(mergeTimeout);
                }

                let result = await merge.json();
                if (!merge.ok || !result.status || !result.path) {
                    throw new Error(result.message || 'Chunk merge failed.');
                }

                $('#videoPath').val(result.path);
                setProgress(100, 'Upload complete ✓');
                window.newVideoUploadedThisSession = true;

            } catch (error) {
                $('#videoPath').val('');
                $('#lessonUID').val('');
                resetProgress();

                // -------------- Message when AbortController fires --------------
                if (error.name === 'AbortError') {
                    alert(
                        'Upload timed out. The server took too long to respond. Please try again.'
                    );
                } else {
                    alert(error.message);
                }
            } finally {
                isUploadingVideo = false;
            }
        });

        window.formSubmitted = false;

        $('form').on('submit', function(e) {
            if (isUploadingVideo) {
                e.preventDefault();
                alert('Video is still uploading. Please wait.');
                return;
            }
            if ($('#videoInput')[0].files.length > 0 && !$('#videoPath').val()) {
                e.preventDefault();
                alert(
                    'Video upload was not completed. Please re-select the video and wait for upload to finish.'
                );
            }
            formSubmitted = true;
        });
        window.addEventListener('beforeunload', function() {
            if (formSubmitted)
                return; // -------------- do not discard on intentional submit --------------
            discardUploadedVideo();
        });
    });
</script>
