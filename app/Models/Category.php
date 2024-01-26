<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'slug',
        'created_by',
        'updated_by'

    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name) . '-' . Str::random(6);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name) . '-' . Str::random(6);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
