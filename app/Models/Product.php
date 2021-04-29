<?php

namespace App\Models;

use App\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use League\CommonMark\Inline\Element\Code;
use phpDocumentor\Reflection\Types\Null_;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model
{

    protected $table = 'products';

    protected $casts = [
        'title' => 'string|required',
        'price' => 'double|required',
        'discount_price' => 'double|required',
        'shipping_method'=>'',
        'shipping_charge'=>'',
        'tax'=>'',
        'brand'=>'',
        'color'=>'',
        'attribute'=>'',
        'choice_options'=>'',
        'unit'=>'required',
        'quantity'=>'required|integer',
        'image' => 'string',
        'description' => 'string',
        'option' => 'json',
        'rate' => 'integer',
        'order_item' => 'integer',
        'slug' => 'string|unique',
        'category_id' => 'integer',
        'feature' => 'boolean',
        'status' => 'boolean',
        'created_by' => 'string',
        'updated_by' => 'string',
    ];

    protected $fillable = [
        'title',
        'price',
        'discount_price',
        'shipping_method',
        'shipping_charge',
        'tax',
        'brand',
        'unit',
        'quantity',
        'color',
        'attribute',
        'choice_options',
        'description',
        'option',
        'rate',
        'order_item',
        'slug',
        'category_id',
        'feature',
        'image',
        'excerpt_description',
        'status',
        'featured_image',
        'created_by',
        'updated_by',

    ];


    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */

    public function getPrice()
    {
        return $this->discount_price != '' ? $this->discount_price : $this->price;
    }

    public function discount()
    {

        if (isset($this->discount_price)) {
            $discount = (($this->price - $this->discount_price)*100) / $this->price ;
            return (int)$discount;
        } else {
            return $discount = Null;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    /**
     * @param $slug
     * @param int $id
     * @return mixed
     */
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Product::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }


    protected function resize_crop_images($max_width, $max_height, $image, $filename)
    {
        $imgSize = getimagesize($image);
        $width = $imgSize[0];
        $height = $imgSize[1];
        $width_new = round($height * $max_width / $max_height);
        $height_new = round($width * $max_height / $max_width);

        if ($width_new > $width) {
            //cut point by height
            $h_point = round(($height - $height_new) / 2);
            $cover = storage_path('app/' . $filename);
            dd($cover);
            Image::make($image)->crop($width, $height_new, 0, $h_point)->resize($max_width, $max_height)->save($cover);
        } else {
            //cut point by width
            $w_point = round(($width - $width_new) / 2);
            $cover = storage_path('app/' . $filename);
//            dd($cover);
            Image::make($image)->crop($width_new, $height, $w_point, 0)->resize($max_width, $max_height)->save($cover);
        }

    }

    public function comments()
    {
        return $this->hasMany(Review::class);
    }

    public function overrallRating()
    {
        $overall = 0;
        $comments =  $this->comments()->sum('rating');
        if($comments != 0)
        { 
             $overall = $comments / $this->comments->count();
        }
      
        return $overall;
    }

    public function product_attribute(){
        return $this->belongsTo('App\Models\Attribute','attribute');
    }



}
