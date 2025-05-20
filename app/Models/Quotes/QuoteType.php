<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteType extends Model
{
    use HasFactory;

    protected $table = 'quote_types';

    protected $fillable = [
        'name',
        'icon',
    ];

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
