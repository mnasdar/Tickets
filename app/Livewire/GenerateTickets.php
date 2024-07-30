<?php

namespace App\Livewire;

use App\Mail\SendEmail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GenerateTicket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class GenerateTickets extends Component
{
    use WithPagination;

    public $search;
    public $getingEmail = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortAsc' => ['except' => true],
    ];
    public $sortBy = 'id';
    public $sortAsc = true;
    public $ticket_id;
    public $form = [
        'email' => '',
    ];

    public function rules()
    {
        return [
            'form.email' => 'required|email|max:255|',
        ];
    }

    public function mount($ticket_id = null)
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

    public function getEmail($id)
    {
        $this->getingEmail = $id;
    }

    public function sendMail(GenerateTicket $generateTicket)
    {
        $generate_ticket = $generateTicket;
        $customPaper = array(0,0,250,190);
        $pdf = Pdf::setOptions(['defaultMediaType' => 'screen','isHtml5ParserEnabled'=>true,'isRemoteEnabled' => true,'chroot' => public_path('storage/qr-code/')])
                    ->setPaper($customPaper)->loadview('print-ticket',compact(['generate_ticket']));
        /* ======== End Generate PDF ======== */
        $validated = $this->validate();
         /* ======== Email Data ======== */
         $mailData = [
            // 'attachment' => public_path('/storage/qr-code/'.$ticket->ticket_code.'.png'), /* ======== Send Image ======== */
            'pdf' => $pdf, /* ======== Send Pdf ======== */
            'ticket_code'=> $generate_ticket->ticket_code, /* ======== Get Ticket Code ======== */
        ];
        /* ======== End Email Data ======== */
        $email = $validated['form']['email'];
        Mail::to($email)->send(new SendEmail( $mailData)); /* ======== Send Email ======== */
        GenerateTicket::where('id', $generate_ticket->id)->update(['email' => $email]); /* ======== Update Email Data From Table Generate Ticket ======== */
        session()->flash('success', 'QR code Ticket has been send to the '.$email); /* ======== Message Email Success ======== */
        $this->getingEmail = false;
    }
    public function printTicket($ticket_code)
    {
        $generate_ticket = GenerateTicket::where('ticket_code', $ticket_code)->first();

        /* ======== Generate PDF ======== */
        $customPaper = array(0, 0, 250, 190);
        $pdf = Pdf::setOptions(['defaultMediaType' => 'screen', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'chroot' => public_path('storage/qr-code/')])
            ->loadview('print-ticket', compact(['generate_ticket']));
        $pdf->setPaper($customPaper);
        return $pdf->stream($ticket_code);
        /* ======== End Generate PDF ======== */
    }

}
