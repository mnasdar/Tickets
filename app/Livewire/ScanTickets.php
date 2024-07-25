<?php

namespace App\Livewire;

use Livewire\Component;

class ScanTickets extends Component
{
    public $event_id;
    public function render()
    {
        return view('livewire.scan-tickets');
    }
}
