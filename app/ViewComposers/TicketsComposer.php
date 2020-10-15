<?php namespace App\ViewComposers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class TicketsComposer
{
    protected $ticket;
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }


    public function compose(View $view)
    {
        if (isset($view->empresa)) {
            $tickets = $this->ticket->where('empresa_id', $view->empresa->id)
                            ->rightJoin('role_ticket', 'role_ticket.ticket_id', '=','tickets.id')
                             ->where('role_ticket.role_id', '=', auth()->user()->getRole())
                            ->where('status', true)->get();

            $view->with(['tickets' => $tickets]);
        }
       
    }
}

