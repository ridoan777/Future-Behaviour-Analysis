<x-app-layout>

   @php
      $breadCrumbs = [
         ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
         ['label' => 'Transactions', 'url' => 'backend.webpages_transactions_pricing', 'icon' => 'dollarSackLine'],
         ['label' => 'Payment'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Transactions: Payment Failed" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->


   <!------------------------------------------------------------------------------------------------>
   <div>
      <h2>Payment cancelled</h2>
      <p>No charges were made.</p>
   </div>

   <!------------------------------------------------------------------------------------------------>


   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>