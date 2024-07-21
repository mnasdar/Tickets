<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Events extends Component
{
    use WithPagination;
    public $confirmingEventDeletion = false;
    public function render()
    {
        $events = Event::where('user_id',auth()->user()->id)->paginate(10);
        return view('livewire.events',compact(['events']));
    }

    public function confirmEventDeletion($id)
    {
        $this->confirmingEventDeletion = $id;
    }
}
