<?php

namespace App\Events;

use App\Models\Restaurant;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RestaurantChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newRestaurant;

    public $oldRestaurant;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Restaurant $newRestaurant, Restaurant $oldRestaurant)
    {
        //
        $this->newRestaurant = $newRestaurant;
        $this->oldRestaurant = $oldRestaurant;
    }

}
