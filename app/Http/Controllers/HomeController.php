<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
    	$c = CarbonImmutable::now();
    	
    	$data['currentMonthIncome'] = Income::whereMonth('date', $c->month)
    		->sum('amount');
    	$data['prevMonthIncome'] = Income::whereMonth('date', $c->subMonth()->month)
    		->sum('amount');
    	$data['yesterdayIncome'] = Income::whereDate('date', $c->subDay()->toDateString())
    		->firstOrFail()
    		->amount;

    	$data['dailyIncome'] = Income::whereBetween('date', [
    			$c->subDays(7)->toDateString(), 
    			$c->subDay()->toDateString()
    		])
    		->selectRaw('
    			SUM(amount) AS total, 
    			date
    		')
    		->groupBy('date')
            ->orderBy('date')
    		->get();

    	$data['monthlyIncome'] = Income::whereBetween('date', [
    			$c->subMonthsNoOverflow(7)->startOfMonth()->toDateString(), 
    			$c->subMonthNoOverflow()->endOfMonth()->toDateString()
    		])
    		->selectRaw("
    			SUM(amount) AS total, 
    			CONCAT(MONTHNAME(date), ' ', YEAR(date)) AS month,
                date
    		")
    		->groupBy('month')
            ->orderBy('date')
    		->get();

    	$data['prevMonthStoreIncome'] = Income::with('store')
    		->whereMonth('date', $c->subMonth()->month)
    		->selectRaw("
    			SUM(amount) AS total,
    			store_id
    		")
    		->groupBy('store_id')
    		->get();

    	return view('pages.dashboard.index', $data);
    }
}
