<div class="mb-4" id="messageArea">
    @if(session('success'))
        <div class="border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold text-center">Success!</strong>
            <span class="block sm:inline text-right">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold text-center">Error!</strong>
            <span class="block sm:inline text-right">{{ session('error') }}</span>
        </div>
    @endif
    
    @if($errors->any())
        <ul>
            <li class="text-blue-500"><b>{{ $message }} Error/s:</b></li>
            @foreach ($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
<script>
    setTimeout(function () {
        const msg = document.getElementById('messageArea');
        if (msg) {
            msg.classList.add('transition-opacity', 'duration-1000', 'opacity-0');
            setTimeout(() => {
                msg.style.display = 'none';
            }, 1000); // Wait for the fade-out to finish
        }
    }, 10000);
</script>