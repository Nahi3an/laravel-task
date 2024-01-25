<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'price',
        'quantity',
        'category_id',
        'created_by',
        'updated_by',

    ];



    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
