<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = "colors";
    protected $fillable = ["title", "slug"];

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
