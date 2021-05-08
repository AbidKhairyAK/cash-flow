<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Income;
use App\Models\Store;
use App\Models\User;
use Faker\Factory;
use Carbon\CarbonImmutable;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Factory::create();
    	$stores = Store::all();
        $users = User::all();

        Income::truncate();

        for ($i=0; $i < 150; $i++) { 
        	$date = CarbonImmutable::now()->subDays($i)->toDateString();

        	foreach ($stores as $store) {
        		if ((!empty($store->event_date)) && $store->event_date != $date) continue;
                $user = $faker->randomElement($users);
		    	Income::create([
                    'user_id' => $user->id,
		    		'store_id' => $store->id,
		    		'date' => $date,
                    'status' => $faker->boolean(80) || $user->role == 'admin' ? 'approved' : $faker->randomElement(['pending', 'disaproved']),
		    		'amount' => rand(5, 15) * 100000
		    	]);
        	}
        }
    }
}
