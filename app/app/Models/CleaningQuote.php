<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleaningQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'property_type',
        'rooms',
        'bathrooms',
        'has_pets',
        'service_date',
        'frequency',
        'details',
        'status',
    ];

    protected $casts = [
        'has_pets'     => 'boolean',
        'service_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
