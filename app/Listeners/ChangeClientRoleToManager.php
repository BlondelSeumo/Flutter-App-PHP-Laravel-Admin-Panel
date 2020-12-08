<?php
/**
 * File name: ChangeClientRoleToManager.php
 * Last modified: 2020.08.13 at 19:18:18
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeClientRoleToManager
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->newRestaurant->active && !$event->oldRestaurant->active){
            foreach ($event->newRestaurant->users as $user){
                $user->syncRoles(['manager']);
            }
        }
    }
}
