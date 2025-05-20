<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteTransportationItem extends Model
{
    use HasFactory;

    protected $table = 'quote_transportation_items';

    protected $fillable = [
        'quote_transportation_id',
        'carrier',
        'capacity_without_lift',
        'capacity_with_lift',
        'number_of_trips',
        'number_of_goings',
        'number_of_comings',
        'price_per_round_trips',
        'price_per_trip',
        'total',
    ];

    public function quoteTransportation()
    {
        return $this->belongsTo(QuoteTransportation::class);
    }
}
