<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Discount;

class UpdateCoupon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update VITX233 coupon to work for all routes and agencies';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $discount = Discount::where('code', 'VITX233')->first();
        
        if ($discount) {
            $discount->agency_id = null;
            $discount->route_id = null;
            $discount->modifier = now();
            $discount->save();
            
            $this->info('Coupon VITX233 updated successfully to work for all routes and agencies!');
        } else {
            $this->error('Coupon VITX233 not found!');
        }
    }
}
