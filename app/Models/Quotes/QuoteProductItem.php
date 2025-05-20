<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteProductItem extends Model
{
    use HasFactory;

    protected $table = 'quote_product_items';

    protected $fillable = [
        'quote_product_id',
        'code',
        'description',
        'width',
        'height',
        'length',
        'weight',
        'price',
        'rental_price_per_day',
        'quantity',
        'rental_days',
        'total',
    ];

    public function quoteProduct()
    {
        return $this->belongsTo(QuoteProduct::class);
    }
}
