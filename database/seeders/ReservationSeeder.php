<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'check_in_date' => '2024-03-01',
                'check_out_date' => '2024-03-05',
                'status' => 'Confirmed',
                'total_price' => 2000,
                'user_id' => 1,
                'espace_id' => 1,
            ],
            [
                'check_in_date' => '2024-03-10',
                'check_out_date' => '2024-03-15',
                'status' => 'Due In',
                'total_price' => 1000,
                'user_id' => 2,
                'espace_id' => 2,
            ],
            [
                'check_in_date' => '2024-03-20',
                'check_out_date' => '2024-03-25',
                'status' => 'Checked In',
                'total_price' => 4000,
                'user_id' => 3,
                'espace_id' => 3,
            ],

        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
