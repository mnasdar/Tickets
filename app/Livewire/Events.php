<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Events extends Component
{
    use WithPagination;
    public $active = false;
    public $q;
    public $confirmingEventDeletion = false;
    public function render()
    {
        $events = Event::where('user_id', auth()->user()->id)
            ->when($this->q, function ($query){
                return $query->where(function ($query){
                    $query->where('name', 'like', '%'.$this->q.'%')
                          ->orWhere('category','like','%'.$this->q.'%')
                          ->orWhere('start_date','like','%'.$this->q.'%')
                          ->orWhere('end_date','like','%'.$this->q.'%')
                          ->orWhere('location','like','%'.$this->q.'%');
            });
            })
            ->when($this->active, function ($query) {
                return $query->where('status', 1);
            });

        $query = $events->tosql();
        $events = $events->paginate(10);

        return view('livewire.events', compact(['events', 'query']));
    }

    public function confirmEventDeletion($id)
    {
        $this->confirmingEventDeletion = $id;
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
        $this->confirmingEventDeletion = false;
    }
}
