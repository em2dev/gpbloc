<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'order_date',
        'delivery_date',
        'start_date',
        'end_date',
        'PO_client',
        'PO_GPBloc',
        'subtotal',
        'discount',
        'total',
        'quote_type_id',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'order_date' => 'date:Y/m/d',
            'delivery_date' => 'date:Y/m/d',
            'start_date' => 'date:Y/m/d',
            'end_date' => 'date:Y/m/d',
            'created_at' => 'date:Y/m/d',
            'updated_at' => 'date:Y/m/d',
        ];
    }

    /**
     * Append custom attributes to the model's array form.
     *
     * @var array
     */
    // protected $appends = ['name'];

    /**
     * Get the formatted total attribute.
     *
     * @return string
     */
    // public function getNameAttribute()
    // {
    //     return 'SOUM' . $this->created_at->year . sprintf("%02s",$this->created_at->month) . $this->created_at->day . '-' . sprintf("%04s", $this->id);
    // }

    public function quoteType()
    {
        return $this->belongsTo(QuoteType::class, 'quote_type_id');
    }

    public function notes()
    {
        return $this->hasOne(QuoteNote::class);
    }

    public function client()
    {
        return $this->hasOne(QuoteClient::class);
    }

    public function product()
    {
        return $this->hasOne(QuoteProduct::class);
    }

    public function option()
    {
        return $this->hasOne(QuoteOption::class);
    }

    public function transportation()
    {
        return $this->hasOne(QuoteTransportation::class);
    }
}
