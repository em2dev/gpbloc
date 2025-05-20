<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteNote extends Model
{
    use HasFactory;

    protected $table = 'quote_notes';

    protected $fillable = [
        'quote_id',
        'quote_valid_days',
        'thawing_days',
        'general_rental_terms',
        'payement_method',
        'bank_transfer',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
