<x-app-layout>

   @php
      $breadCrumbs = [
         ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
         ['label' => 'Tiers', 'url' => 'backend_webpages_transactions_frontend', 'icon' => 'dollarSackLine'],
         ['label' => 'Payment'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Transactions: Payment Success" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->


   <!------------------------------------------------------------------------------------------------>

   @if(auth()->user()->subscribedToPrice('price_1S9AYAGpyCrBPeaKPFoshbTD', 'prod_T5LEaduxul3gdS'))
      <h1>You have subscribed</h1>
      <p>to $34.99 /Month</p>
      <pre>{{ json_encode(auth()->user()->toArray(), JSON_PRETTY_PRINT) }}</pre>
      {{-- @dd(auth()->user()) --}}
   @endif

   @if(auth()->user()->subscribedToPrice('price_1S9AYAGpyCrBPeaKlL2XKXfB', 'prod_T5LEaduxul3gdS'))
      <h1>You have subscribed</h1>
      <p>to $4.99 /Month</p>
      <pre>{{ json_encode(auth()->user()->toArray(), JSON_PRETTY_PRINT) }}</pre>
      {{-- @dd(auth()->user()) --}}
   @endif

   @if(auth()->user()->subscribedToPrice('price_1S9AYAGpyCrBPeaKg6hvVPhR', 'prod_T5LEaduxul3gdS'))
      <h1>You have subscribed</h1>
      <p>to $174.99 /Month</p>
      <pre>{{ json_encode(auth()->user()->toArray(), JSON_PRETTY_PRINT) }}</pre>
      {{-- @dd(auth()->user()) --}}
   @endif
   <!------------------------------------------------------------------------------------------------>
   <div>
      <h2>Payment successful</h2>
      @if(isset($session))
         <div>Session: {{ $session->id }}</div>
         <div>Status: {{ $session->payment_status }}</div>
         @if($session->mode === 'subscription' && $session->subscription)
            <div>Subscription: {{ $session->subscription->id ?? $session->subscription }}</div>
         @endif
      @else
         <div>Thank you! Your payment was processed.</div>
      @endif
   </div>

   <!------------------------------------------------------------------------------------------------>


   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>