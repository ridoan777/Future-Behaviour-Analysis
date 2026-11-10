<x-app-layout>
   @php
      $breadCrumbs = [
         ['label' => 'Forms', 'icon' => 'form'],
         ['label' => 'Contact Us', 'url' => 'backend_forms_contact_us']
      ];
   @endphp


   <x-breadcrumb :crumbs="$breadCrumbs" />

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Contact Form Leads" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   <!-- ---------------- APP AREA Starts ---------------- -->

   <div class="p-6">

      <li><b>Database ID:</b> {{ $contactUs?->id ?? '' }}</li>
      <li><b>Name:</b> {{ $contactUs?->first_name ?? '' }} {{ $contactUs?->last_name ?? '' }}</li>
      <li><b>Email:</b> {{ $contactUs?->email ?? '' }}</li>
      <li><b>Phone:</b> {{ $contactUs?->phone ?? '' }}</li>
      <li><b>Is this user registered?:</b> {{ $contactUs?->registered == 1 ? "Yes" : "No" }}</li>
      <li><b>Description:</b> {{ $contactUs?->description ?? '' }}</li>

   </div>


</x-app-layout>