<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTransportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'carrier',
        'capacity_without_lift',
        'capacity_with_lift',
        'price_per_round_trips',
        'price_per_trip',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
