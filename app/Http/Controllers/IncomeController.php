<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends Controller
{
    public function index()
    {
    	$data['incomeDates'] = Income::groupBy('date')->paginate(5);
    	return view('pages.income.index', $data);
    }

    public function create()
    {
    	return view('pages.income.create');
    }

    public function store()
    {
    	return redirect(route('incomes.index'));
    }

    public function edit()
    {
    	return view('pages.income.index');
    }

    public function update()
    {
    	return view('pages.income.index');
    }

    public function destroy()
    {
    	return view('pages.income.index');
    }
}
