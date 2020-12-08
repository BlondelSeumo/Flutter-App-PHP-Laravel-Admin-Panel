<?php
/**
 * File name: UpdateOrderEarningTable.php
 * Last modified: 2020.05.05 at 17:03:49
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Listeners;

use App\Criteria\Earnings\EarningOfRestaurantCriteria;
use App\Repositories\EarningRepository;

class UpdateOrderEarningTable
{
    /**
     * @var EarningRepository
     */
    private $earningRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EarningRepository $earningRepository)
    {
        //
        $this->earningRepository = $earningRepository;
    }

    /**
     * Handle the event.
     *oldOrder
     * updatedOrder
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->oldStatus != $event->updatedOrder->payment->status) {
            $this->earningRepository->pushCriteria(new EarningOfRestaurantCriteria($event->updatedOrder->foodOrders[0]->food->restaurant->id));
            $restaurant = $this->earningRepository->first();
//            dd($restaurant);
            $amount = 0;

            // test if order delivered to client
            if (!empty($restaurant)) {
                foreach ($event->updatedOrder->foodOrders as $foodOrder) {
                    $amount += $foodOrder['price'] * $foodOrder['quantity'];
                }
                if ($event->updatedOrder->payment->status == 'Paid') {
                    $restaurant->total_orders++;
                    $restaurant->total_earning += $amount;
                    $restaurant->admin_earning += ($restaurant->restaurant->admin_commission / 100) * $amount;
                    $restaurant->restaurant_earning += ($amount - $restaurant->admin_earning);
                    $restaurant->delivery_fee += $event->updatedOrder->delivery_fee;
                    $restaurant->tax += $amount * $event->updatedOrder->tax / 100;
                    $restaurant->save();
                } elseif ($event->oldStatus == 'Paid') {
                    $restaurant->total_orders--;
                    $restaurant->total_earning -= $amount;
                    $restaurant->admin_earning -= ($restaurant->restaurant->admin_commission / 100) * $amount;
                    $restaurant->restaurant_earning -= $amount - (($restaurant->restaurant->admin_commission / 100) * $amount);
                    $restaurant->delivery_fee -= $event->updatedOrder->delivery_fee;
                    $restaurant->tax -= $amount * $event->updatedOrder->tax / 100;
                    $restaurant->save();
                }
            }

        }
    }
}
