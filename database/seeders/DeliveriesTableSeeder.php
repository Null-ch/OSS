<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;

class DeliveriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveries = [
            ['title' => 'Почта России'],
            ['title' => 'CDEK'],
            ['title' => 'Самовывоз'],
        ];

        Delivery::insert($deliveries);
    }
}
