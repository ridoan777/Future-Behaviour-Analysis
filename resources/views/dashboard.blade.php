<x-app-layout>

   {{-- <main
      class="md:ps-65 md:hs-overlay-minified:ps-13 flex h-screen flex-col bg-[##F4F5F7] pb-4 transition-all duration-300 dark:bg-neutral-800">
      --}}
      @php
         $breadCrumbs = [
            // ['label' => 'Users', 'url' => 'backend_all_user', 'icon' => 'userTrippleLine'],
            // ['label' => 'All Users'],
         ];
      @endphp

      <x-breadcrumb :crumbs="$breadCrumbs" />
      <!-- ---------------- APP AREA Starts ---------------- -->
      <div class="text-center">
         <h1 class="!m-0">Welcome back, {{ Auth::user()->first_name }}</h1>
         <h4 class="my-4 text-gray-500">This is the Admin dashboard of</h4>
         <h2>Futures Behavior Analysis</h2>
      </div>

      <!-- ---------------- APP AREA Starts ---------------- -->
      {{--
   </main> --}}

</x-app-layout>