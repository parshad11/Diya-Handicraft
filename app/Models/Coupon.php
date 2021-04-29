<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $fillable = ['title','description','coupon_code','type','price','expiry_date','status'];
}
