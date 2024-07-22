<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class Tickets extends Component
{
    use WithPagination;
    public $active = false;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $confirmingTicketDeletion = false;
    public $confirmingTicketAdd = false;
    public $ticket;
    public $form = [
        'event_id' => '',
        'name' => '',
        'stock' => '',
        'price' => '',
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
            'form.event_id' => 'required',
            'form.name' => 'required|min:3|string',
            'form.stock' => 'required|integer',
            'form.price' => 'required|integer',
        ];
    }

    public function mount()
    {
        $this->ticket = null;
    }
    public function render()
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('event_id', 'like', '%' . $this->search . '%')
                        ->orWhere('name', 'like', '%' . $this->search . '%')
                        ->orWhere('stock', 'like', '%' . $this->search . '%')
                        ->orWhere('price', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->active, function ($query) {
                return $query->where('status', 1);
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'Asc' : 'Desc')
            ->paginate(10);
        $events = Event::where('status', 1)->get();
        return view('livewire.tickets', compact(['tickets', 'events']));
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

    public function saveTicket()
    {
        $this->form['stock'] = intval(str_replace(',', '', $this->form['stock']));
        $this->form['price'] = intval(str_replace(',', '', $this->form['price']));

        $validated = $this->validate();
        if ($this->ticket) {
            // Update existing ticket
            $this->ticket->update($validated['form']);
            session()->flash('success', 'Ticket successfully updated.');
        } else {
            // Create new Ticket
            $validated['form']['user_id'] = auth()->user()->id;
            $validated['form']['status'] = 1;

            Ticket::create($validated['form']);
            session()->flash('success', 'Ticket successfully saved.');
        }

        $this->resetForm();
        $this->confirmingTicketAdd = false;
    }

    public function confirmTicketAdd()
    {
        $this->resetForm();
        $this->confirmingTicketAdd = true;
    }

    public function confirmTicketEdit(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->form = $ticket->toArray();
        $this->confirmingTicketAdd = true;
    }

    public function confirmTicketDeletion($id)
    {
        $this->confirmingTicketDeletion = $id;
    }

    public function deleteTicket(Ticket $ticket)
    {
        $ticket->delete();
        session()->flash('danger', 'Ticket has been deleted.');
        $this->confirmingTicketDeletion = false;
    }

    private function resetForm()
    {
        $this->form = [
            'event_id' => '',
            'name' => '',
            'stock' => '',
            'price' => '',
        ];
        $this->ticket = null;
    }
}
