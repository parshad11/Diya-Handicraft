<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    protected $fillable = [
        'product_id', 'user_id', 'quantity', 'total_price'
    ];

    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
