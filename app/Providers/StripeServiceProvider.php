<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Subscription\SubscriptionKeys;
use Stripe\Stripe;

class StripeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Load Stripe keys from database on every request
        try {
            $keys = SubscriptionKeys::where('status', 1)->first();

            if ($keys) {
                // Override config values with database values
                config([
                    'cashier.key' => $keys->stripe_key,
                    'cashier.secret' => $keys->secret_key,
                    'cashier.webhook.secret' => $keys->webhook_secret,
                    'services.stripe.key' => $keys->stripe_key,
                    'services.stripe.secret' => $keys->secret_key,
                    'services.stripe.webhook.secret' => $keys->webhook_secret,
                ]);


                // Set Stripe API key globally
                Stripe::setApiKey($keys->secret_key);
            }
        } catch (\Exception $e) {
            // Silent fail if table doesn't exist yet (during migration)
            \Log::warning('Could not load Stripe keys from database: ' . $e->getMessage());
        }
    }
}