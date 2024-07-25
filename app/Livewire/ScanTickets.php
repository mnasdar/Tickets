<?php

namespace App\Livewire;

use App\Models\ScanTicket;
use Livewire\Component;
use App\Models\GenerateTicket;
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
    public function render()
    {
        return view('livewire.scan-tickets');
    }
    public function scanTicket()
    {
        // Validasi input
        $validated = $this->validate();

        // Dapatkan ticket_code dari input
        $ticket_code = $this->form['ticket_code'];

        // Cari ticket berdasarkan ticket_code
        $check = GenerateTicket::where('ticket_code', $ticket_code)->first();

        if ($check) {
            // Mengakses event_id dari model Ticket yang berhubungan dengan GenerateTicket
            $event_id = $check->ticket->event_id;

            if ($event_id == $this->event_id) {
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
        return redirect()->route('scan-ticket', $this->event_id);
    }

}
