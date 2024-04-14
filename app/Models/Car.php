<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'plate_number',
        'brand',
        'model',
        'color',
        'year',
        'mileage',
        'due_dates',
    ];

    protected $casts = [
        'due_dates' => 'array',
    ];
}
