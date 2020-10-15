<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 17/01/19
 * Time: 07:57 PM
 */

namespace App\Traits;


use App\Models\TicketsJornal;

trait CheckRoleTicketJornal
{
    public function isRoleTicket($id)
    {
        $ticket = TicketsJornal::findOrFail($id);

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