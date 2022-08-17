<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = "product_details";
    protected $fillable = ["product_id", "color_id", "size_id", "urlphoto"];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
