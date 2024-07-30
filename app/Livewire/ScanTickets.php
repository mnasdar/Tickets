<?php

namespace App\Livewire;

use App\Models\ScanTicket;
use Livewire\Component;
use App\Models\GenerateTicket;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ScanTickets extends Component
{
    public $event_id;
    public $form = [
        'ticket_code' => '',
    ];
    public function rules()
    {
        return [
            'form.ticket_code' => 'required',
        ];
    }
    public function mount()
    {
        $event_id = $this->event_id;
    }
    public function render()
    {
        $event_id = $this->event_id;
        return view('livewire.scan-tickets',compact('event_id'));
    }
    public function scanTicket($event_id, Request $request)
    {
        // Validasi input
        $validate = $request->validate([
            'ticket_code'=>['required'],
        ]);
        // Dapatkan ticket_code dari input
        $ticket_code = $validate['ticket_code'];

        // Cari ticket berdasarkan ticket_code
        $check = GenerateTicket::where('ticket_code', $ticket_code)->first();
        if ($check) {
            // Mengakses event_id dari model Ticket yang berhubungan dengan GenerateTicket
            $eventId = $check->ticket->event_id;

            if ($eventId == $event_id) {
                // Cari ScanTicket berdasarkan generate_ticket_id
                $scan = ScanTicket::where('generate_ticket_id', $check->id)->first();

                if ($scan) {
                    if (is_null($scan->checkin_at)) {
                        // Update ScanTicket dengan checkin
                        $scan->update([
                            'checkin_at' => now(),
                            'checkout_at' => NULL,
                            'scan_checkin' => $scan->scan_checkin + 1,
                        ]);
                        Alert::success('Completed', 'The ticket has checked in successfully');
                    } else {
                        Alert::error('Sorry', 'The ticket has been used');
                    }
                } else {
                    // Buat ScanTicket baru
                    ScanTicket::create([
                        'generate_ticket_id' => $check->id,
                        'checkin_at' => now(),
                        'scan_checkin' => 1,
                    ]);
                    Alert::success('Completed', 'The ticket has checked in successfully');
                }
            } else {
                Alert::error('Sorry', 'The ticket does not belong to this event');
            }
        } else {
            Alert::error('Sorry', 'The ticket has not been found');
        }

        // Redirect setelah semua logika selesai
        return redirect()->route('scan-ticket', $event_id);
    }

}
