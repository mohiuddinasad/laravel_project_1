<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'address',
        'country',
        'state',
        'zip_code',
        'email',
        'phone',
        'total',
        'payment_method',
        'status',
        'order_notes'
    ];
}
