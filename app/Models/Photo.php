<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Photo extends Model
{
    protected $table = "product_images";

    protected $fillable=['image','title','product_id'];

    public function product()
    {
        return $this->belongsToMany(Product::class,'product_id');
    }
}
