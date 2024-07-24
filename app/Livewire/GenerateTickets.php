<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GenerateTicket;

class GenerateTickets extends Component
{
    use WithPagination;

    public $active = false;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $ticket_id;
    public function mount($ticket_id)
    {
        $this->ticket_id = $ticket_id;
    }
    public function render()
    {
        // $data=$this->ticket_id;
        $data = GenerateTicket::where('ticket_id', $this->ticket_id)->get();
        return view('livewire.generate-tickets', compact(['data']));
    }
}
