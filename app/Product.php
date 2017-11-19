<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $fillable = ['name','price','image','description','Seller_id'];

    public function seller()
    {
        return $this->belongsTo('app\User');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image($image)
    {
        return '/storage/cover_images/'.$image;
    }
}
