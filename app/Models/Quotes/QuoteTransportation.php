<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteTransportation extends Model
{
    use HasFactory;

    protected $table = 'quote_transportation';

    protected $fillable = [
        'quote_id',
        'shipping_contact_first_name',
        'shipping_contact_last_name',
        'shipping_contact_email',
        'shipping_contact_phone',
        'client_notes'
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteTransportationItem::class, 'quote_transportation_id');
    }
}
