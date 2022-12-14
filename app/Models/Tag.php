<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = "tags";
    protected $fillable = ["title", "slug", "meta_info"];

    public function tagging()
    {
        return $this->belongsTo(Tagging::class);
    }
}
