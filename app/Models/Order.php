<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_name','phone','email','order_no', 'products', 'total_price', 'billing_details', 'shipping_details'];

}
