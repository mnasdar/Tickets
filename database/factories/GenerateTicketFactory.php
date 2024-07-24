<?php

namespace Database\Factories;

use App\Models\GenerateTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GenerateTicket>
 */
class GenerateTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     */
    protected $model = GenerateTicket::class;
    public function definition(): array
    {
        /**
         * ---- Arti Kode Ticket ----
         * 4 Karakter = "TCK-"
         * 2 Karakter = "Tahun Saat ini"
         * 5 Karakter = "Digit nomor acak otomatis"
         **/

         $prefix = 'TCK-'.date('y');
        return [
            'ticket_code'=> $prefix.$this->faker->unique()->randomNumber(5, true),
        ];
    }
}
