<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Cashier\Cashier;
use App\Models\Subscription\SubscribedUser;
use Carbon\Carbon;
use Exception;

class RepairStripeSubscriptions extends Command
{
    protected $signature = 'stripe:repair-subscriptions {--dry-run : Show what would be updated without making changes}';
    protected $description = 'Repair and sync missed Stripe payments with local subscribed_users records.';

    public function handle()
    {
        $this->info('🔍 Checking for pending or missed Stripe payments...');

        $dryRun = $this->option('dry-run');
        if ($dryRun) {
            $this->warn('⚠️  DRY RUN MODE - No changes will be made');
        }

        // --- CHANGED: Also check records with session_id but status=0 ---
        $subs = SubscribedUser::where('status', 0)
            ->whereNotNull('stripe_checkout_session_id')
            ->get();

        if ($subs->isEmpty()) {
            $this->info('✅ No pending subscriptions found.');
            return Command::SUCCESS;
        }

        $this->info("Found {$subs->count()} pending subscription(s) to check...\n");

        $fixed = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($subs as $sub) {
            try {
                $this->line("Checking SubscribedUser ID {$sub->id}...");

                // Fetch real session info from Stripe
                $session = Cashier::stripe()->checkout->sessions->retrieve(
                    $sub->stripe_checkout_session_id,
                    ['expand' => ['payment_intent', 'subscription']]
                );

                if (!$session) {
                    $this->warn("  ⚠️ Stripe session not found");
                    $skipped++;
                    continue;
                }

                // Check payment status
                if ($session->payment_status !== 'paid') {
                    $this->warn("  ❌ Payment status: {$session->payment_status} (not paid yet)");
                    $skipped++;
                    continue;
                }

                // --- CHANGED: Get tier to calculate valid_until ---
                $tier = $sub->tier;
                if (!$tier) {
                    $this->error("  🔥 Tier not found for SubscribedUser ID {$sub->id}");
                    $errors++;
                    continue;
                }

                // Compute validity based on tier duration
                $validUntil = match ($tier->duration) {
                    'lifetime' => Carbon::now()->addYears(100),
                    'daily' => Carbon::now()->addDay(),
                    default => Carbon::now()->addMonths((int) $tier->duration),
                };

                // --- CHANGED: Extract subscription ID properly ---
                $stripeSubId = null;
                if ($session->mode === 'subscription') {
                    if (is_string($session->subscription)) {
                        $stripeSubId = $session->subscription;
                    } elseif (is_object($session->subscription)) {
                        $stripeSubId = $session->subscription->id;
                    }
                }

                if (!$dryRun) {
                    $sub->update([
                        'status' => 1,
                        'status_note' => 'paid',
                        'stripe_subscription_id' => $stripeSubId,
                        'valid_until' => $validUntil,
                    ]);
                }

                $this->info("  ✅ Fixed! Payment confirmed by Stripe");
                $this->line("     Session: {$sub->stripe_checkout_session_id}");
                $this->line("     Valid until: " . ($validUntil ? $validUntil->format('Y-m-d H:i') : 'lifetime'));
                if ($stripeSubId) {
                    $this->line("     Subscription ID: {$stripeSubId}");
                }
                $this->newLine();

                $fixed++;

            } catch (Exception $e) {
                $this->error("  🔥 Error: " . $e->getMessage());
                $errors++;
            }
        }

        // Summary
        $this->newLine();
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('🎯 Sync Summary:');
        $this->info("   Fixed: {$fixed}");
        $this->info("   Skipped: {$skipped}");
        $this->info("   Errors: {$errors}");
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        if ($dryRun) {
            $this->warn('⚠️  This was a dry run. Run without --dry-run to apply changes.');
        }

        return Command::SUCCESS;
    }
}