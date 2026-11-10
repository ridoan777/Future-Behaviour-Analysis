@include('components.header')

<body class="font-sans antialiased">
   <div id="app_blade" class="bg-gray-100">
      {{-- @include('layouts.navigation') --}}

      <!-- Page Heading -->
      @isset($header)
         <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
               {{ $header }}
            </div>
         </header>
      @endisset
      <!-- Page Heading -->

      <!-- Page Content -->
      <x-sidebar />
      <x-navbar />

      <main
         class="md:ps-65 md:hs-overlay-minified:ps-13 flex flex-col bg-[##F4F5F7] pb-4 transition-all duration-300 dark:bg-neutral-800">
         <div class="min-h-screen w-full px-0 pt-15 sm:px-6 lg:px-8 flex flex-col justify-start sm:justify-start gap-8">

            <!-- ---------------- OUR CONTENTS STARTS HERE ---------------- -->
            {{ $slot }}
            <!-- ---------------- OUR CONTENTS ENDS HERE ---------------- -->

            <div></div>
      </main>
      <!-- Page Content -->

   </div>

   {{-- Dark Mode Flickering/White flash fix --}}
   <script>
      document.addEventListener('DOMContentLoaded', function () {
         const html = document.documentElement;
         const toggle = document.getElementById('darkSwtich');

         if (!toggle) return;

         toggle.checked = html.classList.contains('dark');

         setTimeout(() => {
            html.classList.remove('no-transitions');
         }, 100);

         // Toggle handler
         toggle.addEventListener('change', (e) => {
            if (e.target.checked) {
               html.classList.add('dark');
               localStorage.setItem('hs_theme', 'dark');
            } else {
               html.classList.remove('dark');
               localStorage.setItem('hs_theme', 'light');
            }
         });
      });
   </script>
   {{-- Dark Mode Flickering/White flash fix --}}

   <!-- SUMMERNOTE -->
   <script>
      $('.summernote').summernote({
         placeholder: 'Type here...',
         tabsize: 2,
         height: null,
         minHeight: 120,
         maxHeight: 300,
         focus: true,
         toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
         ]
      });
   </script>
   <!-- SUMMERNOTE -->

   <!--  -->
   {{-- dropify start--}}

   <script src="{{ asset('site_assets/js/dropify.min.js') }}"></script>
   <script>
      $(document).ready(function () {
         $('.dropify').dropify();
      });
   </script>

   <script>
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   </script>
   {{-- dropify end--}}

   {{-- Flowbite JS (No Flowbite CSS/Style bcz it will break the dashboard--}}
   <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
   {{-- Flowbite JS (No Flowbite CSS/Style bcz it will break the dashboard--}}
</body>

</html>