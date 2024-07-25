<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GenerateTicket;

class GenerateTickets extends Component
{
    use WithPagination;

    public $search;
    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortAsc' => ['except' => true],
    ];
    public $sortBy = 'id';
    public $sortAsc = true;
    public $ticket_id;
    public function mount($ticket_id =null)
    {
        $this->ticket_id = $ticket_id;
    }
    public function render()
    {
        // $data=$this->ticket_id;
        $data = GenerateTicket::where('ticket_id', $this->ticket_id)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('ticket_code', 'like', '%' . $this->search . '%')
                        ->orWhere(function ($query) {
                            $query->whereIn('ticket_id', function ($subquery) {
                                $subquery->select('id')
                                    ->from('tickets')
                                    ->where('name', 'like', '%' . $this->search . '%');
                            });
                        });
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'Asc' : 'Desc')
            ->paginate(10);
        return view('livewire.generate-tickets', compact(['data']));
    }
    
}
