<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Income;
use App\Models\Item;
use App\Models\IncomeDetail;
use Faker\Factory;

class IncomeDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $incomes = Income::all();
        $items = Item::all();

        IncomeDetail::truncate();

        foreach ($incomes as $income) {
        	$total = 0;
        	foreach ($items as $item) {
        		$qty = rand(5, 30);
        		$subtotal = $item->price * $qty;
        		$total += $subtotal;
        		IncomeDetail::create([
        			'income_id' => $income->id,
        			'item_id' => $item->id,
        			'price' => $item->price,
        			'qty' => $qty,
        			'subtotal' => $subtotal
        		]);
        	}
        	Income::find($income->id)->update(['total' => $total]);
        }
    }
}
