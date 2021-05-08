<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use Faker\Factory;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = ['CPI', 'Toko Lantai 2', 'Penjualan Online', 'Event Hijab Expo'];

        Store::truncate();

        foreach ($stores as $index => $store) {
        	Store::create([
        		'name' => $store,
        		'event_date' => $index == count($stores) - 1 ? '2021-04-01' : null
        	]);
        }
    }
}
