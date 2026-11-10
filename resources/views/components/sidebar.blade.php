<div id="hs-pro-sidebar"
    class="hs-overlay hs-overlay-open:translate-x-0 w-65 hs-overlay-minified:w-13 z-60 fixed inset-y-0 start-0 hidden -translate-x-full transform overflow-hidden border-e border-gray-200 bg-gray-50 shadow-lg transition-all duration-300 [--auto-close:md] md:bottom-0 md:end-auto md:block md:translate-x-0 dark:border-neutral-700 dark:bg-neutral-800"
    role="dialog" tabindex="-1" aria-label="Sidebar">

    <div class="relative flex h-full max-h-full flex-col">

        <!-- --------------------- Sidebar Header --------------------- -->
        <header class="flex items-center justify-between gap-x-2 px-4 py-2.5">
            <div class="-ms-2 flex items-center gap-x-1">

                <div class="md:hs-overlay-minified:hidden">
                    <a href="/" aria-label="Preline">
                        <x-ui_items.application-logo logoClass="jencjen" classLight="w-full mx-auto" classDark="w-full" />
                    </a>
                </div>

                <!-- Sidebar Toggle (TO EXPAND) -->
                <button type="button" class="md:hs-overlay-minified:flex sidebarToggleButtonNonSmallDevice"
                    aria-haspopup="dialog" aria-expanded="true" aria-controls="hs-pro-sidebar"
                    aria-label="Minify navigation" data-hs-overlay-minifier="#hs-pro-sidebar">

                    <span class="hs-overlay-minified:block hidden">
                        {!! \App\Helpers\IconPack::bracketRight(['class' => 'iconPackItem w-5 h-5 text-gray-500 dark:text-gray-200']) !!}
                    </span>
                    <span class="hs-overlay-minified:hidden">
                        {!! \App\Helpers\IconPack::bracketRight(['class' => 'iconPackItem w-5 h-5 text-gray-500 dark:text-gray-200']) !!}
                    </span>
                    <span class="sr-only">Sidebar Toggle</span>

                </button>
                <!-- End Sidebar Toggle (TO EXPAND) -->

                <div class="md:hs-overlay-minified:hidden hidden sm:block"></div>
            </div>

            <!-- Sidebar Toggle (TO COLLAPSE) -->
            <button type="button" class="md:hs-overlay-minified:hidden sidebarToggleButtonNonSmallDevice md:flex"
                aria-haspopup="dialog" aria-expanded="true" aria-controls="hs-pro-sidebar"
                aria-label="Minify navigation" data-hs-overlay-minifier="#hs-pro-sidebar">

                <span class="hs-overlay-minified:block hidden">
                    {!! \App\Helpers\IconPack::bracketLeft(['class' => 'iconPackItem w-5 h-5 text-gray-500 dark:text-gray-200']) !!}
                </span>
                <span class="hs-overlay-minified:hidden">
                    {!! \App\Helpers\IconPack::bracketLeft(['class' => 'iconPackItem w-5 h-5 text-gray-500 dark:text-gray-200']) !!}
                </span>
                <span class="sr-only">Sidebar Toggle</span>

            </button>
            <!-- End Sidebar Toggle (TO COLLAPSE) -->

            <!-- Sidebar Toggle OPENED in SM devices -->
            <button type="button"
                class="focus:outline-hidden flex size-6 items-center justify-center gap-x-3 rounded-full border border-gray-200 bg-gray-200 text-sm text-gray-600 hover:bg-gray-100 focus:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 md:hidden dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-200 dark:focus:bg-neutral-700 dark:focus:text-neutral-200"
                data-hs-overlay="#hs-pro-sidebar" aria-label="Close Sidebar">

                {!! \App\Helpers\IconPack::closeX(['class' => 'iconPackItem w-5 h-5 text-gray-500 dark:text-gray-200']) !!}

                <span class="sr-only">Close</span>
            </button>
            <!-- End Sidebar Toggle OPENED in SM devices -->

        </header>
        <!-- --------------------- /Sidebar Header --------------------- -->

        
        <!-- --------------------- Sidebar-Body --------------------- -->
        <!-- <aside id="hs-pro-sidebar" class="h-full w-0 overflow-hidden bg-white transition-all duration-300 ease-in-out md:w-64 dark:bg-neutral-800"> -->
        <div class="h-full overflow-hidden overflow-y-auto py-5 transition-all duration-300 ease-in-out [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar]:w-2"
            id="sidebarBody">

            <nav class="hs-accordion-group flex w-full flex-col flex-wrap" data-hs-accordion-always-open>

                <ul class="flex flex-col space-y-1">
                    <li>
                        <a class="dropdownMenuButton" href="{{ route('dashboard') }}">
                            {!! \App\Helpers\IconPack::homeLines(['class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200']) !!}
                            Dashboard
                        </a>
                    </li>

                    <li class="my-1" id="users-accordion-1">
                        <button type="button" class="dropdownMenuButton w-full" data-target="users-accordion-child-1"
                            data-state="closed">
                            <span>
                                {!! \App\Helpers\IconPack::documentLines([
                                    'class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200',
                                ]) !!}
                            </span>
                            WebPages
                            <span class="accordion-chevron-up ms-auto hidden">
                                {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            <span class="accordion-chevron-down ms-auto block">
                                {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                        </button>

                        <div id="users-accordion-child-1" class="custom-accordion-content w-full overflow-hidden"
                            style="max-height: 0; opacity: 0;">
                            <ul class="space-y-1 ps-8 pt-1">

                                <li class="my-1" id="sidebar-accordion-sub-4-1">
                                    <button type="button" class="dropdownMenuButton w-full"
                                        data-target="sidebar-accordion-sub-4-1-child" data-state="closed">
                                        Homepage
                                        <span class="accordion-chevron-up ms-auto hidden">
                                            {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                        <span class="accordion-chevron-down ms-auto block">
                                            {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                    </button>
                                    <div id="sidebar-accordion-sub-4-1-child"
                                        class="custom-accordion-content w-full overflow-hidden"
                                        style="max-height: 0; opacity: 0;">
                                        <ul class="space-y-1 pt-1">
                                            <li class="hover:position-realtive">
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.webpages_homepage_head') }}">
                                                    Head section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.webpages_homepage_process') }}">
                                                    Process section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.webpages_homepage_info_icons') }}">
                                                    Sets Us Apart section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.webpages_homepage_course_cards') }}">
                                                    Cards section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.webpages_homepage_starrer') }}">
                                                    Starrer section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.webpages_homepage_feedback') }}">
                                                    Feedback section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.webpages_homepage_mission') }}">
                                                    Mission section
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="my-1" id="sidebar-accordion-sub-4-2">
                                    <button type="button" class="dropdownMenuButton w-full"
                                        data-target="sidebar-accordion-sub-4-2-child" data-state="closed">
                                        About Us
                                        <span class="accordion-chevron-up ms-auto hidden">
                                            {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                        <span class="accordion-chevron-down ms-auto block">
                                            {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                    </button>
                                    <div id="sidebar-accordion-sub-4-2-child"
                                        class="custom-accordion-content w-full overflow-hidden"
                                        style="max-height: 0; opacity: 0;">
                                        <ul class="space-y-1 pt-1">
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_webpages_about_us_program_info') }}">
                                                    Customize About Us
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="my-1" id="sidebar-accordion-sub-4-4">
                                    <button type="button" class="dropdownMenuButton w-full"
                                        data-target="sidebar-accordion-sub-4-4-child" data-state="closed">
                                        Course Page
                                        <span class="accordion-chevron-up ms-auto hidden">
                                            {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                        <span class="accordion-chevron-down ms-auto block">
                                            {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                    </button>
                                    <div id="sidebar-accordion-sub-4-4-child"
                                        class="custom-accordion-content w-full overflow-hidden"
                                        style="max-height: 0; opacity: 0;">
                                        <ul class="space-y-1 pt-1">
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_webpages_coursepage') }}">
                                                    Index
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="my-1" id="sidebar-accordion-sub-4-5">
                                    <button type="button" class="dropdownMenuButton w-full"
                                        data-target="sidebar-accordion-sub-4-5-child" data-state="closed">
                                        Contact
                                        <span class="accordion-chevron-up ms-auto hidden">
                                            {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                        <span class="accordion-chevron-down ms-auto block">
                                            {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                    </button>
                                    <div id="sidebar-accordion-sub-4-5-child"
                                        class="custom-accordion-content w-full overflow-hidden"
                                        style="max-height: 0; opacity: 0;">
                                        <ul class="space-y-1 pt-1">
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_webpages_contact') }}">
                                                    Customize Contact Us
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="my-1" id="sidebar-accordion-sub-4-6">
                                    <button type="button" class="dropdownMenuButton w-full"
                                        data-target="sidebar-accordion-sub-4-6-child" data-state="closed">
                                        Common Sections
                                        <span class="accordion-chevron-up ms-auto hidden">
                                            {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                        <span class="accordion-chevron-down ms-auto block">
                                            {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                    </button>
                                    <div id="sidebar-accordion-sub-4-6-child"
                                        class="custom-accordion-content w-full overflow-hidden"
                                        style="max-height: 0; opacity: 0;">
                                        <ul class="space-y-1 pt-1">
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.common_section_banner') }}">
                                                    Banner section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.common_section_faq') }}">
                                                    FAQ section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.common_section_newsletter') }}">
                                                    Newsletter section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.common_section_footer') }}">
                                                    Footer section
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend.common_section_privacy_conditions') }}">
                                                    Policy + Conditions
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="my-1" id="users-accordion-2">
                        <button type="button" class="dropdownMenuButton w-full"
                            data-target="users-accordion-child-2" data-state="closed">
                            <span>
                                {!! \App\Helpers\IconPack::form(['class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            Forms
                            <span class="accordion-chevron-up ms-auto hidden">
                                {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            <span class="accordion-chevron-down ms-auto block">
                                {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                        </button>
                        <div id="users-accordion-child-2" class="custom-accordion-content w-full overflow-hidden"
                            style="max-height: 0; opacity: 0;">
                            <ul class="space-y-1 ps-8 pt-1">
                                <li>
                                    <a class="sidebarAnchorTagStyle"
                                        href="{{ route('backend.forms_newsletter') }}">Newsletters</a>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle"
                                        href="{{ route('backend_forms_contact_us') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="my-1" id="users-accordion-2">
                        <button type="button" class="dropdownMenuButton w-full"
                            data-target="users-accordion-child-3" data-state="closed">
                            <span>
                                {!! \App\Helpers\IconPack::book(['class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            Course Management
                            <span class="accordion-chevron-up ms-auto hidden">
                                {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            <span class="accordion-chevron-down ms-auto block">
                                {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                        </button>
                        <div id="users-accordion-child-3" class="custom-accordion-content w-full overflow-hidden"
                            style="max-height: 0; opacity: 0;">
                            <ul class="space-y-1 ps-8 pt-1">
                                <li>
                                    <a class="sidebarAnchorTagStyle"
                                        href="{{ route('backend_courses_create') }}">Make Courses</a>
                                </li>
                                <li class="my-1" id="sidebar-accordion-sub-3-1">
                                    <button type="button"
                                        class="dropdownMenuButton sidebarAnchorTagStyle w-full focus:bg-gray-700"
                                        data-target="sidebar-accordion-sub-3-1-child" data-state="closed">
                                        Course Lists
                                        <span class="accordion-chevron-up ms-auto hidden">
                                            {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                        <span class="accordion-chevron-down ms-auto block">
                                            {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                    </button>
                                    <div id="sidebar-accordion-sub-3-1-child"
                                        class="custom-accordion-content w-full overflow-hidden"
                                        style="max-height: 0; opacity: 0;">
                                        <ul class="space-y-1 pt-1">
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_all_courses') }}">
                                                    All Courses
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_all_modules') }}">
                                                    All Modules
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_all_lessons') }}">
                                                    All Lessons
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_all_instructors') }}">
                                                    All Instructors
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_all_lesson_resources') }}">
                                                    Lesson Resources
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle"
                                        href="{{ route('backend_quizzes_create') }}">Make Quizzes</a>
                                </li>
                                <li class="my-1" id="sidebar-accordion-sub-3-2">
                                    <button type="button"
                                        class="dropdownMenuButton sidebarAnchorTagStyle w-full focus:bg-gray-700"
                                        data-target="sidebar-accordion-sub-3-2-child" data-state="closed">
                                        Quiz Section Lists
                                        <span class="accordion-chevron-up ms-auto hidden">
                                            {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                        </span>
                                        <span class="accordion-chevron-down ms-auto block">
                                            {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                                    </button>
                                    <div id="sidebar-accordion-sub-3-2-child"
                                        class="custom-accordion-content w-full overflow-hidden"
                                        style="max-height: 0; opacity: 0;">
                                        <ul class="space-y-1 pt-1">
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_quizzes_create') }}">
                                                    Make Quizzes
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidebarAnchorTagStyle"
                                                    href="{{ route('backend_all_quizzes') }}">
                                                    All Quiz Sets
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="hidden">
                                    <a class="sidebarAnchorTagStyle"
                                        href="{{ route('backend.forms_newsletter') }}">...</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    {{-- <li class="my-1">
                  <a href="{{ route('test') }}" class="dropdownMenuButton">
                     <span>
                        {!! \App\Helpers\IconPack::calenderLine(['class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200']) !!}
                     </span>
                     Calendar
                  </a>
               </li> --}}

                    <li class="my-1" id="users-accordion-7">
                        <button type="button" class="dropdownMenuButton w-full"
                            data-target="users-accordion-child-7" data-state="closed">
                            <span>
                                {!! \App\Helpers\IconPack::ribbon(['class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            Certifications
                            <span class="accordion-chevron-up ms-auto hidden">
                                {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            <span class="accordion-chevron-down ms-auto block">
                                {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                        </button>
                        <div id="users-accordion-child-7" class="custom-accordion-content w-full overflow-hidden"
                            style="max-height: 0; opacity: 0;">
                            <ul class="space-y-1 ps-8 pt-1">
                                <li>
                                    <a class="sidebarAnchorTagStyle" href="{{ route('backend_certs_create') }}">
                                        Modify Metadata
                                    </a>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle" href="{{ route('backend_all_certs') }}">
                                        All Certificates
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="my-1" id="users-accordion-4">
                        <button type="button" class="dropdownMenuButton w-full"
                            data-target="users-accordion-child-4" data-state="closed">
                            <span>
                                {!! \App\Helpers\IconPack::dollarSackLine([
                                    'class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200',
                                ]) !!}
                            </span>
                            Subscriptions
                            <span class="accordion-chevron-up ms-auto hidden">
                                {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            <span class="accordion-chevron-down ms-auto block">
                                {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                        </button>
                        <div id="users-accordion-child-4" class="custom-accordion-content w-full overflow-hidden"
                            style="max-height: 0; opacity: 0;">
                            <ul class="space-y-1 ps-8 pt-1">
                                <li class="hidden">
                                    <a class="sidebarAnchorTagStyle"
                                        href="{{ route('backend_webpages_transactions_frontend') }}">
                                        Frontend/Test
                                    </a>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle"
                                        href="{{ route('backend.webpages_transactions_pricing') }}">
                                        Packages/Tiers
                                    </a>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle"
                                        href="{{ route('backend_subscription_all_subscribers') }}">
                                        All Subscribers
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="my-1" id="users-accordion-8">
                        <button type="button" class="dropdownMenuButton w-full"
                            data-target="users-accordion-child-8" data-state="closed">
                            <span>
                                {!! \App\Helpers\IconPack::ribbon(['class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            Progress
                            <span class="accordion-chevron-up ms-auto hidden">
                                {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            <span class="accordion-chevron-down ms-auto block">
                                {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                        </button>
                        <div id="users-accordion-child-8" class="custom-accordion-content w-full overflow-hidden"
                            style="max-height: 0; opacity: 0;">
                            <ul class="space-y-1 ps-8 pt-1">
                                <li>
                                    <a class="sidebarAnchorTagStyle" href="{{ route('backend_all_results') }}">
                                       Results
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    {{-- <span class="sectionName mb-1 mt-2 px-12 py-2.5 text-xs font-semibold text-gray-400">MANAGEMENT</span> --}}

                    <li class="my-1">
                        <a class="sidebarSectionText !hover:bg-white">
                            <span class="invisible">
                                {!! \App\Helpers\IconPack::calenderLine([
                                    'class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200',
                                ]) !!}
                            </span>
                            <span class="mb-1 mt-2 text-xs font-semibold text-gray-400">
                                MANAGEMENT
                            </span>
                        </a>
                    </li>

                    <li class="my-1" id="users-accordion-5">
                        <button type="button" class="dropdownMenuButton w-full"
                            data-target="users-accordion-child-5" data-state="closed">
                            <span>
                                {!! \App\Helpers\IconPack::userTripple([
                                    'class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200',
                                ]) !!}
                            </span>
                            Users
                            <span class="accordion-chevron-up ms-auto hidden">
                                {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            <span class="accordion-chevron-down ms-auto block">
                                {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                        </button>
                        <div id="users-accordion-child-5" class="custom-accordion-content w-full overflow-hidden"
                            style="max-height: 0; opacity: 0;">
                            <ul class="space-y-1 ps-8 pt-1">
                                <li>
                                    <a class="sidebarAnchorTagStyle" href="{{ route('backend_all_user') }}">
                                        All Users
                                        <span>
                                            {!! \App\Helpers\IconPack::userGear(['class' => 'iconPackItem w-4 h-4 text-gray-400']) !!}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle hidden" href="#">
                                        Pending Users
                                        <span>
                                            {!! \App\Helpers\IconPack::userFocus(['class' => 'iconPackItem w-4 h-4 text-gray-400']) !!}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle" href="{{ route('backend_user_blacklist') }}">
                                        Blacklisted
                                        <span>
                                            {!! \App\Helpers\IconPack::userCancel(['class' => 'iconPackItem w-4 h-4 text-gray-400']) !!}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="my-1 hidden" id="users-accordion-6">
                        <button type="button" class="dropdownMenuButton w-full"
                            data-target="users-accordion-child-6" data-state="closed">
                            <span>
                                {!! \App\Helpers\IconPack::key(['class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            Role Management
                            <span class="accordion-chevron-up ms-auto hidden">
                                {!! \App\Helpers\IconPack::chevronUp(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                            <span class="accordion-chevron-down ms-auto block">
                                {!! \App\Helpers\IconPack::chevronDown(['class' => 'iconPackItem w-4 h-4 text-gray-500 dark:text-gray-200']) !!}
                            </span>
                        </button>
                        <div id="users-accordion-child-6" class="custom-accordion-content w-full overflow-hidden"
                            style="max-height: 0; opacity: 0;">
                            <ul class="space-y-1 ps-8 pt-1">
                                <li>
                                    <a class="sidebarAnchorTagStyle" href="#">
                                        Users with Roles
                                    </a>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle" href="#">
                                        Roles
                                    </a>
                                </li>
                                <li>
                                    <a class="sidebarAnchorTagStyle" href="#">
                                        Permissions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="my-1 hidden">
                        <button type="button" class="dropdownMenuButton">
                            <span>
                                {!! \App\Helpers\IconPack::calenderLine([
                                    'class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200',
                                ]) !!}
                            </span>
                            Calendar
                        </button>
                    </li>

                    {{-- <span class="sectionName mb-1 mt-2 px-12 py-2.5 text-xs font-semibold text-gray-400">ASSISTANCE</span> --}}

                    <li class="my-1 hidden">
                        <a class="sidebarSectionText !hover:bg-white">
                            <span class="invisible">
                                {!! \App\Helpers\IconPack::calenderLine([
                                    'class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200',
                                ]) !!}
                            </span>
                            <span class="mb-1 mt-2 text-xs font-semibold text-gray-400">
                                ASSISTANCE
                            </span>
                        </a>
                    </li>

                    <li class="my-1 hidden">
                        <a class="sidebarNoDropdownButton" href="{{ route('backend.components') }}">
                            {!! \App\Helpers\IconPack::hourglassHalf([
                                'class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200',
                            ]) !!}
                            Components
                        </a>
                    </li>

                    <li class="my-1 hidden">
                        <a class="sidebarNoDropdownButton" href="#">
                            {!! \App\Helpers\IconPack::book(['class' => 'iconPackItem w-5 h-5 mr-2 text-gray-500 dark:text-gray-200']) !!}
                            Documentation
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <!-- </aside> -->
        <!-- --------------------- /Sidebar-Body --------------------- -->
    </div>

</div>

{{-- -------------------- Style+Script to smoother sidebar menus -------------------- --}}
<script>
    document.querySelectorAll('.dropdownMenuButton[data-target]').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const content = document.getElementById(targetId);
            const state = this.dataset.state;
            const chevronUp = this.querySelector('.accordion-chevron-up');
            const chevronDown = this.querySelector('.accordion-chevron-down');

            if (!content) return;

            content.style.transition = 'max-height 0.4s ease, opacity 0.3s ease';

            if (state === 'closed') {
                // --- Expand ---
                content.style.maxHeight = content.scrollHeight + 'px';
                content.style.opacity = '1';
                this.dataset.state = 'open';
                chevronUp?.classList.remove('hidden');
                chevronDown?.classList.add('hidden');

                // If it's child accordion, expand parent too
                const parentAccordion = this.closest('.custom-accordion-content');
                if (parentAccordion) {
                    parentAccordion.style.maxHeight =
                        parentAccordion.scrollHeight + 500 + 'px';
                }

            } else {
                // --- Collapse ---
                content.style.maxHeight = '0px';
                content.style.opacity = '0';
                this.dataset.state = 'closed';
                chevronUp?.classList.add('hidden');
                chevronDown?.classList.remove('hidden');

                // If it's child accordion, shrink parent too
                const parentAccordion = this.closest('.custom-accordion-content');
                if (parentAccordion) {
                    parentAccordion.style.maxHeight =
                        parentAccordion.scrollHeight - 500 + 'px';
                }
            }
        });
    });
</script>

{{-- -------------------- Style+Script to smoother sidebar menus -------------------- --}}


{{-- ---- Script to hide section names (e.g., Management) during collapse ------ --}}
<script>
    function toggleSectionNames() {
        const sidebar = document.querySelector('#sidebarBody');
        const sectionNames = document.querySelectorAll('.sectionName');

        if (sidebar && sectionNames.length > 0) {
            const collapsed = sidebar.offsetWidth <= 100; // Increase threshold
            console.log('Sidebar width:', sidebar.offsetWidth, 'Collapsed:', collapsed); // Debug

            sectionNames.forEach(el => {
                el.style.display = collapsed ? 'none' : 'block';
            });
        }
    }

    // Trigger on page load
    document.addEventListener('DOMContentLoaded', () => setTimeout(toggleSectionNames, 100));

    // Trigger when sidebar toggle buttons are clicked
    document.addEventListener('click', (e) => {
        if (e.target.closest('[data-hs-overlay-minifier="#hs-pro-sidebar"]')) {
            setTimeout(toggleSectionNames, 300);
        }
    });
</script>
{{-- -------------------- Script to hide section names -------------------- --}}


{{-- -------------------- Sidebar Toggle Button -------------------- --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fix mobile sidebar overlay issue
        const sidebarToggle = document.querySelector('[data-hs-overlay="#hs-pro-sidebar"]');
        const sidebar = document.getElementById('hs-pro-sidebar');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                // Remove any stuck backdrop after a short delay
                setTimeout(() => {
                    const backdrop = document.getElementById('hs-pro-sidebar-backdrop');
                    if (backdrop && !sidebar.classList.contains('open')) {
                        backdrop.remove();
                    }
                }, 300);
            });

            // Also handle clicks on the backdrop itself
            document.addEventListener('click', function(e) {
                if (e.target && e.target.id === 'hs-pro-sidebar-backdrop') {
                    e.target.remove();
                }
            });
        }
    });
</script>
{{-- -------------------- Sidebar Toggle Button -------------------- --}}
