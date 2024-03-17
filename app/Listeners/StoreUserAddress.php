<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreUserAddress
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void
    {
        $user = $event->user;
        $addresses = $event->addresses;

        $user->addresses()->delete();
        $formattedAddresses = [];

        foreach ($addresses as $address) {
            $formattedAddresses[] = ['address' => $address];
        }
        if (!empty($formattedAddresses)) {
            $user->addresses()->createMany($formattedAddresses);
        }
    }
}
