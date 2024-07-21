<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class Events extends Component
{
    use WithPagination;

    public $active = false;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $confirmingEventDeletion = false;
    public $confirmingEventAdd = false;
    public $event;
    public $form = [
        'name' => '',
        'category' => '',
        'description' => '',
        'start_date' => '',
        'end_date' => '',
        'location' => '',
    ];

    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortAsc' => ['except' => true],
    ];

    public function rules()
    {
        return [
            'form.name' => 'required|min:5|string',
            'form.category' => 'required',
            'form.description' => 'required|min:5',
            'form.start_date' => 'required|date|after:tomorrow',
            'form.end_date' => 'required|date|after:form.start_date',
            'form.location' => 'required|min:5|string',
        ];
    }

    public function mount()
    {
        $this->event = null;
    }

    public function render()
    {
        $events = Event::where('user_id', auth()->user()->id)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('category', 'like', '%' . $this->search . '%')
                        ->orWhere('start_date', 'like', '%' . $this->search . '%')
                        ->orWhere('end_date', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->active, function ($query) {
                return $query->where('status', 1);
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'Asc' : 'Desc')
            ->paginate(10);

        return view('livewire.events', compact('events'));
    }

    public function orderBy($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortBy = $field;
    }

    public function saveEvent()
    {
        $validated = $this->validate();
        // Convert the dates back to the format expected by the database
        $validated['form']['start_date'] = Carbon::parse($validated['form']['start_date'])->format('Y-m-d');
        $validated['form']['end_date'] = Carbon::parse($validated['form']['end_date'])->format('Y-m-d');

        if ($this->event) {
            // Update existing event
            $this->event->update($validated['form']);
            session()->flash('success', 'Event successfully updated.');
        } else {
            // Create new event
            $validated['form']['user_id'] = auth()->user()->id;
            $validated['form']['status'] = 1;

            Event::create($validated['form']);
            session()->flash('success', 'Event successfully saved.');
        }

        $this->resetForm();
        $this->confirmingEventAdd = false;
    }

    public function confirmEventAdd()
    {
        $this->resetForm();
        $this->confirmingEventAdd = true;
    }

    public function confirmEventEdit(Event $event)
    {
        $this->event = $event;
        $this->form = $event->toArray();
        // Format the dates to Y-m-d for the form input fields
        $this->form['start_date'] = Carbon::parse($event->start_date)->format('Y-m-d');
        $this->form['end_date'] = Carbon::parse($event->end_date)->format('Y-m-d');
        $this->confirmingEventAdd = true;
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

    private function resetForm()
    {
        $this->form = [
            'name' => '',
            'category' => '',
            'description' => '',
            'start_date' => '',
            'end_date' => '',
            'location' => '',
        ];
        $this->event = null;
    }
}
