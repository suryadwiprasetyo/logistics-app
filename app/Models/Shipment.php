<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice',
        'cwb',
        'origin',
        'destination',
        'date',
        'customer_id',
        'company_name',
        'receiver_name',
        'type',
        'qty',
        'weight',
        'subtotal',
    ];
}
