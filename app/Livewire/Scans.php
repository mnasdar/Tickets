<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\ScanTicket;
use Livewire\WithPagination;

class Scans extends Component
{
    use WithPagination;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortAsc' => ['except' => true],
    ];
    public function render()
    {
        $events = Event::where('user_id', auth()->user()->id)
            ->where('status', 1)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('category', 'like', '%' . $this->search . '%')
                        ->orWhere('start_date', 'like', '%' . $this->search . '%')
                        ->orWhere('end_date', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'Asc' : 'Desc');

        // $query = $events->toSql();
        $events= $events->paginate(10);
        // $data = ScanTicket::all();
        return view('livewire.scans',compact('events'));
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
    public function redirectScanTicket($event_id)
    {
        return redirect()->route('scan-ticket', [$event_id]);
    }
}
