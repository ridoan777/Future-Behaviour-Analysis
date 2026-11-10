<x-app-layout>

   {{-- <main class="md:ps-65 md:hs-overlay-minified:ps-13 flex h-screen flex-col bg-[##F4F5F7] pb-4 transition-all duration-300 dark:bg-neutral-800"> --}}
   @php
      $breadCrumbs = [
          // ['label' => 'Users', 'url' => 'backend_all_user', 'icon' => 'userTrippleLine'],
          // ['label' => 'All Users'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->
   <h1 class="text-2xl dark:text-gray-200">Components Demo</h1>

   {{--  --}}
   <div class="hs-accordion-group">
      <div class="hs-accordion active" id="hs-basic-nested-heading-one">
         <button
            class="hs-accordion-toggle hs-accordion-active:text-blue-600 focus:outline-hidden dark:hs-accordion-active:text-blue-500 inline-flex w-full items-center gap-x-3 rounded-lg py-3 text-start font-semibold text-gray-800 hover:text-gray-500 focus:text-gray-500 disabled:pointer-events-none disabled:opacity-50 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
            aria-expanded="true" aria-controls="hs-basic-nested-collapse-one">
            <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
               height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
               <path d="M5 12h14"></path>
               <path d="M12 5v14"></path>
            </svg>
            <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
               height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
               <path d="M5 12h14"></path>
            </svg>
            Accordion #1
         </button>
         <div id="hs-basic-nested-collapse-one"
            class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="region"
            aria-labelledby="hs-basic-nested-heading-one">
            <div class="hs-accordion-group ps-6">
               <div class="hs-accordion active" id="hs-basic-nested-sub-heading-one">
                  <button
                     class="hs-accordion-toggle hs-accordion-active:text-blue-600 focus:outline-hidden dark:hs-accordion-active:text-blue-500 inline-flex w-full items-center gap-x-3 rounded-lg py-3 text-start font-semibold text-gray-800 hover:text-gray-500 focus:text-gray-500 disabled:pointer-events-none disabled:opacity-50 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                     aria-expanded="true" aria-controls="hs-basic-nested-sub-collapse-one">
                     <svg class="hs-accordion-active:hidden block size-3" width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2"
                           stroke-linecap="round"></path>
                        <path d="M8.12421 13.36V2.35999" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        </path>
                     </svg>
                     <svg class="hs-accordion-active:block hidden size-3" width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2"
                           stroke-linecap="round"></path>
                     </svg>
                     Sub accordion #1
                  </button>
                  <div id="hs-basic-nested-sub-collapse-one"
                     class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="region"
                     aria-labelledby="hs-basic-nested-sub-heading-one">
                     <p class="text-gray-800 dark:text-neutral-200">
                        <em>This is the first item's accordion body.</em> It is hidden by default, until the collapse
                        plugin adds the appropriate classes that we use to style each element. These classes control the
                        overall appearance, as well as the showing and hiding via CSS transitions.
                     </p>
                  </div>
               </div>

               <div class="hs-accordion" id="hs-basic-nested-sub-heading-two">
                  <button
                     class="hs-accordion-toggle hs-accordion-active:text-blue-600 focus:outline-hidden dark:hs-accordion-active:text-blue-500 inline-flex w-full items-center gap-x-3 rounded-lg py-3 text-start font-semibold text-gray-800 hover:text-gray-500 focus:text-gray-500 disabled:pointer-events-none disabled:opacity-50 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                     aria-expanded="false" aria-controls="hs-basic-nested-sub-collapse-two">
                     <svg class="hs-accordion-active:hidden block size-3" width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2"
                           stroke-linecap="round"></path>
                        <path d="M8.12421 13.36V2.35999" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        </path>
                     </svg>
                     <svg class="hs-accordion-active:block hidden size-3" width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2"
                           stroke-linecap="round"></path>
                     </svg>
                     Sub accordion #2
                  </button>
                  <div id="hs-basic-nested-sub-collapse-two"
                     class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                     role="region" aria-labelledby="hs-basic-nested-sub-heading-two">
                     <p class="text-gray-800 dark:text-neutral-200">
                        <em>This is the second item's accordion body.</em> It is hidden by default, until the collapse
                        plugin adds the appropriate classes that we use to style each element. These classes control the
                        overall appearance, as well as the showing and hiding via CSS transitions.
                     </p>
                  </div>
               </div>

               <div class="hs-accordion" id="hs-basic-nested-sub-heading-three">
                  <button
                     class="hs-accordion-toggle hs-accordion-active:text-blue-600 focus:outline-hidden dark:hs-accordion-active:text-blue-500 inline-flex w-full items-center gap-x-3 rounded-lg py-3 text-start font-semibold text-gray-800 hover:text-gray-500 focus:text-gray-500 disabled:pointer-events-none disabled:opacity-50 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                     aria-expanded="false" aria-controls="hs-basic-nested-sub-collapse-three">
                     <svg class="hs-accordion-active:hidden block size-3" width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2"
                           stroke-linecap="round"></path>
                        <path d="M8.12421 13.36V2.35999" stroke="currentColor" stroke-width="2"
                           stroke-linecap="round"></path>
                     </svg>
                     <svg class="hs-accordion-active:block hidden size-3" width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2"
                           stroke-linecap="round"></path>
                     </svg>
                     Sub accordion #3
                  </button>
                  <div id="hs-basic-nested-sub-collapse-three"
                     class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                     role="region" aria-labelledby="hs-basic-nested-sub-heading-three">
                     <p class="text-gray-800 dark:text-neutral-200">
                        <em>This is the third item's accordion body.</em> It is hidden by default, until the collapse
                        plugin adds the appropriate classes that we use to style each element. These classes control the
                        overall appearance, as well as the showing and hiding via CSS transitions.
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="hs-accordion" id="hs-basic-nested-heading-two">
         <button
            class="hs-accordion-toggle hs-accordion-active:text-blue-600 focus:outline-hidden dark:hs-accordion-active:text-blue-500 inline-flex w-full items-center gap-x-3 rounded-lg py-3 text-start font-semibold text-gray-800 hover:text-gray-500 focus:text-gray-500 disabled:pointer-events-none disabled:opacity-50 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
            aria-expanded="false" aria-controls="hs-basic-nested-collapse-two">
            <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
               height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
               <path d="M5 12h14"></path>
               <path d="M12 5v14"></path>
            </svg>
            <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
               height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
               <path d="M5 12h14"></path>
            </svg>
            Accordion #2
         </button>
         <div id="hs-basic-nested-collapse-two"
            class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region"
            aria-labelledby="hs-basic-nested-heading-two">
            <p class="text-gray-800 dark:text-neutral-200">
               <em>This is the second item's accordion body.</em> It is hidden by default, until the collapse plugin
               adds the appropriate classes that we use to style each element. These classes control the overall
               appearance, as well as the showing and hiding via CSS transitions.
            </p>
         </div>
      </div>

      <div class="hs-accordion" id="hs-basic-nested-heading-three">
         <button
            class="hs-accordion-toggle hs-accordion-active:text-blue-600 focus:outline-hidden dark:hs-accordion-active:text-blue-500 inline-flex w-full items-center gap-x-3 rounded-lg py-3 text-start font-semibold text-gray-800 hover:text-gray-500 focus:text-gray-500 disabled:pointer-events-none disabled:opacity-50 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
            aria-expanded="false" aria-controls="hs-basic-nested-collapse-three">
            <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
               height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
               <path d="M5 12h14"></path>
               <path d="M12 5v14"></path>
            </svg>
            <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
               height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
               <path d="M5 12h14"></path>
            </svg>
            Accordion #3
         </button>
         <div id="hs-basic-nested-collapse-three"
            class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region"
            aria-labelledby="hs-basic-nested-heading-three">
            <p class="text-gray-800 dark:text-neutral-200">
               <em>This is the third item's accordion body.</em> It is hidden by default, until the collapse plugin adds
               the appropriate classes that we use to style each element. These classes control the overall appearance,
               as well as the showing and hiding via CSS transitions.
            </p>
         </div>
      </div>
   </div>

   {{--  --}}
   <div class="buttonsRGBFilled">
      <h1>buttonsRGBFilled</h1>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-gray-800 px-4 py-3 text-sm font-medium text-white hover:bg-gray-900 focus:bg-gray-900 disabled:pointer-events-none disabled:opacity-50 dark:bg-white dark:text-neutral-800">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-gray-500 px-4 py-3 text-sm font-medium text-white hover:bg-gray-600 focus:bg-gray-600 disabled:pointer-events-none disabled:opacity-50">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-teal-500 px-4 py-3 text-sm font-medium text-white hover:bg-teal-600 focus:bg-teal-600 disabled:pointer-events-none disabled:opacity-50">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-4 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-red-500 px-4 py-3 text-sm font-medium text-white hover:bg-red-600 focus:bg-red-600 disabled:pointer-events-none disabled:opacity-50">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-yellow-500 px-4 py-3 text-sm font-medium text-white hover:bg-yellow-600 focus:bg-yellow-600 disabled:pointer-events-none disabled:opacity-50">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-white px-4 py-3 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:bg-gray-200 disabled:pointer-events-none disabled:opacity-50">
         Button
      </button>
   </div>
   {{--  --}}
   <div class="buttonsRGBGhostBlanked">
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent px-4 py-3 text-sm font-medium text-gray-800 hover:bg-gray-100 focus:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent px-4 py-3 text-sm font-medium text-gray-500 hover:bg-gray-100 focus:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent px-4 py-3 text-sm font-medium text-teal-500 hover:bg-teal-100 hover:text-teal-800 focus:bg-teal-100 disabled:pointer-events-none disabled:opacity-50 dark:hover:bg-teal-800/30 dark:hover:text-teal-400 dark:focus:text-teal-400">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent px-4 py-3 text-sm font-medium text-blue-600 hover:bg-blue-100 hover:text-blue-800 focus:bg-blue-100 focus:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:bg-blue-800/30 dark:hover:text-blue-400 dark:focus:bg-blue-800/30 dark:focus:text-blue-400">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent px-4 py-3 text-sm font-medium text-red-500 hover:bg-red-100 hover:text-red-800 focus:bg-red-100 disabled:pointer-events-none disabled:opacity-50 dark:hover:bg-red-800/30 dark:hover:text-red-400 dark:focus:bg-red-800/30 dark:focus:text-red-400">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent px-4 py-3 text-sm font-medium text-yellow-500 hover:bg-yellow-100 hover:text-yellow-800 focus:bg-yellow-100 disabled:pointer-events-none disabled:opacity-50 dark:hover:bg-yellow-800/30 dark:hover:text-yellow-400 dark:focus:bg-yellow-800/30 dark:focus:text-yellow-400">
         Button
      </button>
      <button type="button"
         class="focus:outline-hidden inline-flex items-center gap-x-2 rounded-lg border border-transparent px-4 py-3 text-sm font-medium text-white hover:bg-gray-100 hover:text-gray-800 focus:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:hover:bg-white/10 dark:hover:text-white dark:focus:bg-white/10 dark:focus:text-white">
         Button
      </button>
   </div>
   {{--  --}}
   <div class="buttonGradientFilled">

      <button type="button"
         class="mb-2 me-2 rounded-lg bg-gradient-to-br from-purple-600 to-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">Purple
         to Blue</button>
      <button type="button"
         class="mb-2 me-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-cyan-300 dark:focus:ring-cyan-800">Cyan
         to Blue</button>
      <button type="button"
         class="mb-2 me-2 rounded-lg bg-gradient-to-br from-green-400 to-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-green-200 dark:focus:ring-green-800">Green
         to Blue</button>
      <button type="button"
         class="mb-2 me-2 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-l focus:outline-none focus:ring-4 focus:ring-purple-200 dark:focus:ring-purple-800">Purple
         to Pink</button>
      <button type="button"
         class="mb-2 me-2 rounded-lg bg-gradient-to-br from-pink-500 to-orange-400 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-pink-200 dark:focus:ring-pink-800">Pink
         to Orange</button>
      <button type="button"
         class="mb-2 me-2 rounded-lg bg-gradient-to-r from-teal-200 to-lime-200 px-5 py-2.5 text-center text-sm font-medium text-gray-900 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:outline-none focus:ring-4 focus:ring-lime-200 dark:focus:ring-teal-700">Teal
         to Lime</button>
      <button type="button"
         class="mb-2 me-2 rounded-lg bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 px-5 py-2.5 text-center text-sm font-medium text-gray-900 hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-red-100 dark:focus:ring-red-400">Red
         to Yellow</button>

   </div>
   {{--  --}}
   <div class="buttonGradientBlanked">

      <button
         class="group relative mb-2 me-2 inline-flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-purple-600 to-blue-500 p-0.5 text-sm font-medium text-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-300 group-hover:from-purple-600 group-hover:to-blue-500 dark:text-white dark:focus:ring-blue-800">
         <span
            class="relative rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-transparent dark:bg-gray-900 group-hover:dark:bg-transparent">
            Purple to blue
         </span>
      </button>
      <button
         class="group relative mb-2 me-2 inline-flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-cyan-500 to-blue-500 p-0.5 text-sm font-medium text-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-cyan-200 group-hover:from-cyan-500 group-hover:to-blue-500 dark:text-white dark:focus:ring-cyan-800">
         <span
            class="relative rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-transparent dark:bg-gray-900 group-hover:dark:bg-transparent">
            Cyan to blue
         </span>
      </button>
      <button
         class="group relative mb-2 me-2 inline-flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-green-400 to-blue-600 p-0.5 text-sm font-medium text-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-green-200 group-hover:from-green-400 group-hover:to-blue-600 dark:text-white dark:focus:ring-green-800">
         <span
            class="relative rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-transparent dark:bg-gray-900 group-hover:dark:bg-transparent">
            Green to blue
         </span>
      </button>
      <button
         class="group relative mb-2 me-2 inline-flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 p-0.5 text-sm font-medium text-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-purple-200 group-hover:from-purple-500 group-hover:to-pink-500 dark:text-white dark:focus:ring-purple-800">
         <span
            class="relative rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-transparent dark:bg-gray-900 group-hover:dark:bg-transparent">
            Purple to pink
         </span>
      </button>
      <button
         class="group relative mb-2 me-2 inline-flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-orange-400 p-0.5 text-sm font-medium text-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-pink-200 group-hover:from-pink-500 group-hover:to-orange-400 dark:text-white dark:focus:ring-pink-800">
         <span
            class="relative rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-transparent dark:bg-gray-900 group-hover:dark:bg-transparent">
            Pink to orange
         </span>
      </button>
      <button
         class="group relative mb-2 me-2 inline-flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-teal-300 to-lime-300 p-0.5 text-sm font-medium text-gray-900 focus:outline-none focus:ring-4 focus:ring-lime-200 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 dark:focus:ring-lime-800">
         <span
            class="relative rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-transparent dark:bg-gray-900 group-hover:dark:bg-transparent">
            Teal to Lime
         </span>
      </button>
      <button
         class="group relative mb-2 me-2 inline-flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 p-0.5 text-sm font-medium text-gray-900 focus:outline-none focus:ring-4 focus:ring-red-100 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 dark:focus:ring-red-400">
         <span
            class="relative rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-transparent dark:bg-gray-900 group-hover:dark:bg-transparent">
            Red to Yellow
         </span>
      </button>

   </div>


   <!-- ---------------- APP AREA Starts ---------------- -->
   {{-- </main> --}}

</x-app-layout>
