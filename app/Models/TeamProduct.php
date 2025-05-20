<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'code',
        'description',
        'width',
        'height',
        'lenght',
        'weight',
        'price',
        'rental_price_per_day',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
