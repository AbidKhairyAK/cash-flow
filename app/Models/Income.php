<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $casts = [
    	'date' => 'date:Y-m-d'
    ];

    public function store()
    {
    	return $this->belongsTo(Store::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
