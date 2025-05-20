<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteClient extends Model
{
    use HasFactory;

    protected $table = 'quote_client';

    protected $fillable = [
        'quote_id',
        'name',
        'phone',
        'email',
        'website',
        'description',
        'address',
        'city',
        'province',
        'zip',
        'delivery_address',
        'delivery_city',
        'delivery_province',
        'delivery_zip',
        'contact_first_name',
        'contact_last_name',
        'contact_email',
        'contact_phone',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
