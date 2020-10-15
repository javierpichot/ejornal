<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Models\Audit;


class LogSuccessfulLogout
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
    public function handle(Logout $event)
    {
        try {
            Audit::create([
                'user_type'          =>  'App\User',
                'user_id'       =>  $event->user->id,
                'event' => 'Auth',
                'auditable_type' => 'App\User',
                'auditable_id' => $event->user->id,
                'ip_address'    =>  \Illuminate\Support\Facades\Request::ip(),
                'user_agent'    =>  \Illuminate\Support\Facades\Request::header('User-Agent'),
                'url' => \Illuminate\Support\Facades\Request::fullUrl()
            ]);
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
