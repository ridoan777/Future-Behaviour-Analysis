<x-app-layout>
    @php
        $breadCrumbs = [
            ['label' => 'Subscribers', 'url' => 'backend_subscription_all_subscribers', 'icon' => 'userTrippleLine'],
            ['label' => 'Single Subscribers'],
        ];
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />


    <!-- Start Main Widgets -->
    <x-page_header_widget pageName="Subscription: Subscriber Details" />
    <!-- End Main Widgets -->


    <!-- Alert Component -->
    <x-alert-component message="Subscribers List" />
    <!-- Alert Component -->

    <!-- ---------------- APP AREA Starts ---------------- -->
    <div class="p-6">
        <!------------ USER INFORMATION ------------>
        <div class="bg-gray-100 dark:bg-neutral-700 shadow-lg rounded-lg p-6 space-y-4">
            <h3 class="mb-8">SUBSCRIBER INFORMATION</h3>

            <div class="grid grid-cols-4 gap-8">
                <div class="col-span-1">
                    @php
                        $getAvatar = $subscribedUser ? $subscribedUser?->avatar : null;
                        if ($getAvatar) {
                            $avatar = Storage::url($getAvatar);
                        } else {
                            $avatar = asset('site_assets/dummies/dummy_man.webp');
                        }
                    @endphp
                    <a href="{{ route('backend_all_user') }}" target="_blank" rel="noopener">
                        <img src="{{ $avatar }}" alt="{{ $getAvatar ?? 'no-avatar' }}"
                            class="rounded-lg cursor-pointer hover:scale-105">
                    </a>
                </div>
                <div class="col-span-3 space-y-4">
                    <div class="grid grid-cols-12 gap-4">
                        <P class="col-span-3 font-bold">DB ID:</P>
                        <p class="col-span-9">{{ $subscribedUser?->id ?? null }}</p>
                    </div>
                    <!----->
                    <div class="grid grid-cols-12 gap-4">
                        <P class="col-span-3 font-bold">DB UID:</P>
                        <p class="col-span-9">{{ $subscribedUser?->user_uid ?? null }}</p>
                    </div>
                    <!----->
                    <div class="grid grid-cols-12 gap-4">
                        <P class="col-span-3 font-bold">User Name:</P>
                        <p class="col-span-9">{{ $subscribedUser?->first_name }} {{ $subscribedUser?->last_name }}</p>
                    </div>
                    <!----->
                    <div class="grid grid-cols-12 gap-4">
                        <P class="col-span-3 font-bold">Email:</P>
                        <p class="col-span-9">{{ $subscribedUser?->email ?? null }}</p>
                    </div>
                    <!----->
                    <div class="grid grid-cols-12 gap-4">
                        <P class="col-span-3 font-bold">Phone:</P>
                        <p class="col-span-9">{{ $subscribedUser?->phone ?? null }}</p>
                    </div>
                    <!----->
                </div>
            </div>

        </div>
        <!------------ USER INFORMATION ------------>


        <!------------ SUBSCRIPTION INFORMATION ------------>
        <div class="my-4 bg-gray-100 dark:bg-neutral-700 shadow-lg rounded-lg p-6 space-y-4">
            <h3 class="mb-8">SUBSCRIPTION INFORMATION</h3>

            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">DB ID:</P>
                <p class="col-span-10">{{ $subscription?->id ?? null }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Paid Amount:</P>
                <p class="col-span-10">${{ number_format($subscription?->paid_amount, 2, '.', '') ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Duration:</P>
                <p class="col-span-10">{{ $subscription?->duration ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Valid Until:</P>
                <p class="col-span-10">{{ $subscription?->valid_until ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-3 font-bold">Age Consent:</P>
                <p class="col-span-3">{{ $subscription?->age_consent ? 'YES' : 'NO' }}</p>
                <P class="col-span-3 font-bold">Education Consent:</P>
                <p class="col-span-3">{{ $subscription?->education_consent ? 'YES' : 'NO' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Billing Reason:</P>
                <p class="col-span-10">{{ $subscription?->billing_reason ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-3 font-bold">Status:</P>
                <p class="col-span-3">{{ $subscription?->status ?? 'N/A' }}</p>
                <P class="col-span-3 font-bold">Status Note:</P>
                <p class="col-span-3">{!! \App\Helpers\Ui\DatatableHelper::phaseColor($subscription?->status_note) !!}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">Stripe Checkout Session ID:</P>
                <p class="col-span-8">{{ $subscription?->stripe_checkout_session_id ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">Stripe Subscription ID:</P>
                <p class="col-span-8">{{ $subscription?->stripe_subscription_id ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <p class="col-span-4 font-bold">Last Traced Invoice:</p>
                <p class="col-span-8 break-all">
                    <a href="{{ $subscription?->last_invoice }}" target="_blank" class="text-blue-600 underline">
                        {{ $subscription?->last_invoice }}
                    </a>
                </p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">Last Transaction:</P>
                <p class="col-span-8">{{ $subscription?->last_transaction ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">Cancel Request At:</P>
                <p class="col-span-8">{{ $subscription?->cancel_req_at ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">First Created At:</P>
                <p class="col-span-8">{{ $subscription?->created_at ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">Last Updated At:</P>
                <p class="col-span-8">{{ $subscription?->updated_at ?? 'N/A' }}</p>
            </div>
            <!----->

        </div>
        <!------------ SUBSCRIPTION INFORMATION ------------>


        <!------------ TIER INFORMATION ------------>
        <div class="my-4 bg-gray-100 dark:bg-neutral-700 shadow-lg rounded-lg p-6 space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="mb-8">TIER INFORMATION</h3>
                <a href="{{ route('backend_transactions_payment_edit', $tier->id) }}"
                    class="inline-block p-2 rounded-full bg-gray-200">
                    {!! \App\Helpers\IconPack::telegramArrow(['class' => 'iconPackItem w-5 h-5 text-cyan-600']) !!}
                </a>
            </div>

            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">DB ID:</P>
                <p class="col-span-10">{{ $tier?->id ?? null }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Tier Name:</P>
                <p class="col-span-10">{{ $tier?->tier_name ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Title:</P>
                <p class="col-span-10">{{ $tier?->title ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Sub-Title:</P>
                <p class="col-span-10">{{ $tier?->subtitle ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Starting Price:</P>
                <p class="col-span-10">${{ number_format($tier?->starting_price, 2, '.', '') ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Final Price:</P>
                <p class="col-span-10">${{ number_format($tier?->final_price, 2, '.', '') ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4 items-start">
                <p class="col-span-2 font-bold">Benefits:</p>
                <div class="col-span-10 p-4 break-words [&_ul]:list-disc [&_ul]:pl-5 [&_li]:mb-1 bg-[#e5e7eb]">
                    {!! $tier?->benefits ?? 'N/A' !!}
                </div>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">First Created At:</P>
                <p class="col-span-8">{{ $tier?->created_at ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">Last Updated At:</P>
                <p class="col-span-8">{{ $tier?->updated_at ?? 'N/A' }}</p>
            </div>
            <!----->

        </div>
        <!------------ TIER INFORMATION ------------>


        <!------------ COURSE INFORMATION ------------>
        <div class="my-4 bg-gray-100 dark:bg-neutral-700 shadow-lg rounded-lg p-6 space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="mb-8">COURSE INFORMATION</h3>
                <a href="{{ route('backend_courses_edit', $course->id) }}"
                    class="inline-block p-2 rounded-full bg-gray-200">
                    {!! \App\Helpers\IconPack::telegramArrow(['class' => 'iconPackItem w-5 h-5 text-cyan-600']) !!}
                </a>
            </div>

            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">DB ID:</P>
                <p class="col-span-10">{{ $course?->id ?? null }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Course UID:</P>
                <p class="col-span-10">{{ $course?->course_uid ?? null }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">Title:</P>
                <p class="col-span-10">{{ $course?->title ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <p class="col-span-2 font-bold">Description:</p>
                <div class="col-span-10 p-4 break-words [&_ul]:list-disc [&_ul]:pl-5 [&_li]:mb-1 bg-[#e5e7eb]">
                    {!! $course?->description ?? 'N/A' !!}
                </div>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">First Created At:</P>
                <p class="col-span-8">{{ $course?->created_at ?? 'N/A' }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-4 font-bold">Last Updated At:</P>
                <p class="col-span-8">{{ $course?->updated_at ?? 'N/A' }}</p>
            </div>
            <!----->

        </div>
        <!------------ COURSE INFORMATION ------------>


        <!------------ PROGRESS INFORMATION ------------>
        <div class="my-4 bg-gray-100 dark:bg-neutral-700 shadow-lg rounded-lg p-6 space-y-4" id="progressSubscriber">
            <div class="flex justify-between items-center">
                <h3 class="mb-8">PROGRESS INFORMATION</h3>
                <a href="{{ route('backend_courses_edit', $course->id) }}"
                    class="inline-block p-2 rounded-full bg-gray-200">
                    {!! \App\Helpers\IconPack::telegramArrow(['class' => 'iconPackItem w-5 h-5 text-cyan-600']) !!}
                </a>
            </div>

            <div class="grid grid-cols-12 gap-4">
                <P class="col-span-2 font-bold">DB ID:</P>
                <p class="col-span-10">{{ $course?->id ?? null }}</p>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-10 grid grid-cols-12 gap-4">
                    <P class="col-span-2 font-bold">Total Lessons:</P>
                    <p class="col-span-2">{{ $courseProgress?->total_lessons ?? 'N/A' }}</p>
                    <P class="col-span-2 font-bold">Completed:</P>
                    <p class="col-span-2">{{ $courseProgress?->completed_lessons ?? 'N/A' }}</p>
                    <P class="col-span-2 font-bold">Percentage:</P>
                    <p class="col-span-2">
                        {{ $courseProgress?->progress_lessons ? $courseProgress?->progress_lessons . '%' : 'N/A' }}</p>
                </div>
                @php
                    $selectBadge = [
                        'none' => asset('site_assets/dummies/badges/no_badge.png'),
                        'bronze' => asset('site_assets/dummies/badges/bronze.png'),
                        'silver' => asset('site_assets/dummies/badges/silver.png'),
                        'gold' => asset('site_assets/dummies/badges/gold.png'),
                        'platinum' => asset('site_assets/dummies/badges/platinum.png'),
                    ];

                    $badgeKey = $courseProgress?->current_badge ?? 'none';
                @endphp

                <div class="col-span-2">
                    <div class="">
                        <img src="{{ $selectBadge[$badgeKey] ?? $selectBadge['none'] }}" alt="badge"
                            class="w-16 h-auto mx-auto">
                    </div>
                </div>
            </div>
            <!----->
            <div class="my-8 grid grid-cols-12 gap-4">
                <h5 class="col-span-12 font-bold text-gray-500">QUIZ PROGRESSION</h5>
            </div>
            <!----->
            <div class="grid grid-cols-12 gap-4">
                @foreach ($quizProgress as $index => $quiz)
                    <div class="p-4 col-span-4 bg-gray-300 grid gap-2 rounded-lg">
                        <div class="col-span-4 grid grid-cols-6 gap-4 bg-gray-300">
                            <P class="col-span-3 font-bold">QUIZ ID:</P>
                            <p class="col-span-3">{{ $quiz?->id ?? null }}</p>
                        </div>
                        <div class="col-span-4 grid grid-cols-6 gap-4 bg-gray-300">
                            <P class="col-span-3 font-bold">Is Complete?:</P>
                            <p class="col-span-3">{{ $quiz?->is_complete ? "Yes" : "No" }}</p>
                        </div>
                        <div class="col-span-4 grid grid-cols-6 gap-4 bg-gray-300">
                            <P class="col-span-3 font-bold">Is Passed?:</P>
                            <p class="col-span-3">{{ $quiz?->is_passed ? "Yes" : "No" }}</p>
                        </div>
                        <div class="col-span-4 grid grid-cols-6 gap-4 bg-gray-300">
                            <P class="col-span-3 font-bold">Marks Gained:</P>
                            <p class="col-span-3">{{ $quiz?->total_mark ?? "N/A" }}</p>
                        </div>
                        <div class="col-span-4 grid grid-cols-6 gap-4 bg-gray-300">
                            <P class="col-span-3 font-bold">Passing Marks:</P>
                            <p class="col-span-3">{{ $quiz?->required_mark ?? "N/A" }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!----->

        </div>
        <!------------ PROGRESS INFORMATION ------------>

    </div>

    <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
<style>
    p {
        padding: 16px;
        border-radius: 8px;
        background-color: #e5e7eb;
    }

    .dark p {
        color: #e5e7eb;
        background-color: #737373;
    }
</style>
