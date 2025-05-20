<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteOption extends Model
{
    use HasFactory;

    protected $table = 'quote_option';

    protected $fillable = [
        'quote_id',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteOptionItem::class, 'quote_option_id');
    }
}
