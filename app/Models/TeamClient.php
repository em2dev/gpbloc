<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamClient extends Model
{
    use HasFactory;

    protected $table = 'team_client';

    protected $fillable = [
        'team_id',
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

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
