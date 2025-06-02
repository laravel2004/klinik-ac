<?php

namespace App\Console\Commands;

use App\Enums\OrderStatus;
use App\Models\ServiceOrder;
use Illuminate\Console\Command;

class CancelDueServiceOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancel-due-service-orders-items-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically cancel service orders scheduled to start at the current time.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $updated = ServiceOrder::where('status', OrderStatus::PENDING)
            ->where('start_time', '<=', now())
            ->update(['status' => OrderStatus::CANCELED]);

        $this->info("Updated {$updated} due service orders.");

        return self::SUCCESS;
    }
}
