<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product' => $this->collection->map(function ($data) {
                return [
                    'id'=>$data->id,
                    'title'=>$data->title,
                    'price'=>$data->price,
                    'discount_price'=>$data->discount_price,
                    'shipping_metod'=>$data->shipping_metod,
                    'shipping_charge'=>$data->shipping_charge,
                    'tax'=>$data->tax,
                    'brand'=>$data->brand,
                    'quantity'=>$data->quantity,
                    'color'=>explode(',',$data->color),
                    'size'=>explode(',',$data->size),
                    'rate'=>$data->rate,
                    'description'=>$data->description,
                    'excerpt_description'=>$data->excerpt_description,
                    'image'=>asset('/storage/products/'.$data->image),
                    'slug'=>$data->slug,
                ];
            })
        ];
    }


}
