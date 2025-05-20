<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteOptionItem extends Model
{
    use HasFactory;

    protected $table = 'quote_option_items';

    protected $fillable = [
        'quote_option_id',
        'name',
        'quantity',
        'unit_price',
        'total',
    ];

    public function quoteOption()
    {
        return $this->belongsTo(QuoteOption::class);
    }
}
