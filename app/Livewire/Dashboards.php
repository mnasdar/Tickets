<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\GenerateTicket;
use App\Models\Ticket;
use Livewire\Component;

class Dashboards extends Component
{
    public function render()
    {
        $count_event = Event::count();
        $count_ticket = Ticket::count();
        $count_generate_ticket = GenerateTicket::count();
        return view('livewire.dashboards', compact(['count_event','count_ticket','count_generate_ticket']));
    }
}
