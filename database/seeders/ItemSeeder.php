<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Faker\Factory;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ['Madu', 'Jus Kurma', 'Minuman Bobba', 'Bakso Bakar', 'Burger & Kebab'];

        Item::truncate();

        foreach ($items as $item) {
        	Item::create([
        		'name' => $item,
        		'price' => rand(5, 15) * 1000
        	]);
        }
    }
}
