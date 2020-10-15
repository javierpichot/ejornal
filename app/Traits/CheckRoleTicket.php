<?php
/**
 * Created by PhpStorm.
 * User: vdjke
 * Date: 9/17/2018
 * Time: 8:48 a.m.
 */

namespace App\Traits;


use App\Models\Ticket;

trait CheckRoleTicket
{
    public function isRoleTicket($id)
    {
        $ticket = Ticket::findOrFail($id);

        if (auth()->check()) {
            if (!$ticket->role_ticket(auth()->user()->getRole()) && !auth()->user()->isRole('admin')) {
                if (request()->ajax()) {
                    return response('Unauthorized.', 403);
                }

                abort(403, 'Unauthorized action.');
            }
        }
    }

}