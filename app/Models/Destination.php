<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'country',
        'region',
        'cost_level',
        'average_daily_budget',
        'annual_visitors',

    ];

    protected function casts(): array
    {
        return [
            'activities' => 'array',
            'average_daily_budget' => 'integer',
            'annual_visitors' => 'integer',
        ];
    }
}
