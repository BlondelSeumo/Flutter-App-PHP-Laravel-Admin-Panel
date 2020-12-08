<?php
/**
 * File name: OrderChangedEvent.php
 * Last modified: 2020.05.06 at 10:12:53
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $oldStatus;

    public $updatedOrder;

    /**
     * OrderChangedEvent constructor.
     * @param $oldOrder
     * @param $updatedOrder
     */
    public function __construct($oldStatus, $updatedOrder)
    {
        $this->oldStatus = $oldStatus;
        $this->updatedOrder = $updatedOrder;
    }


}
