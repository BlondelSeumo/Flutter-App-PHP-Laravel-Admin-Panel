<?php
/**
 * File name: UpdateOrderDriverTable.php
 * Last modified: 2020.05.06 at 10:12:55
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Listeners;


use App\Criteria\Users\FilterByUserCriteria;
use App\Repositories\DriverRepository;

class UpdateOrderDriverTable
{
    /**
     * @var DriverRepository
     */
    private $driverRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DriverRepository $driverRepository)
    {

        $this->driverRepository = $driverRepository;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        // test if order delivered and paid by the client
        if ($event->oldStatus != $event->updatedOrder->payment->status && isset($event->updatedOrder->driver)) {
            $this->driverRepository->pushCriteria(new FilterByUserCriteria($event->updatedOrder->driver->id));
            $driver = $this->driverRepository->first();
            if (!empty($driver)) {
                if ($event->updatedOrder->payment->status == 'Paid' && $event->updatedOrder->orderStatus->id == 5) {
                    $driver->total_orders++;
                    $driver->earning += $event->updatedOrder->delivery_fee * $driver->delivery_fee / 100;
                    $driver->save();
                } elseif ($event->oldStatus == 'Paid') {
                    $driver->total_orders--;
                    $driver->earning -= $event->updatedOrder->delivery_fee * $driver->delivery_fee / 100;
                    $driver->save();
                }
            }
        }
    }
}
