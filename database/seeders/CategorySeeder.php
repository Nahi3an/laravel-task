<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Category for electronic devices',


            ],
            [
                'name' => 'Clothing',
                'description' => 'Category for clothing items',


            ],
            [
                'name' => 'Books',
                'description' => 'Category for books and literature',


            ],
            [
                'name' => 'Home and Furniture',
                'description' => 'Category for home decor and furniture',


            ],
            [
                'name' => 'Sports and Outdoors',
                'description' => 'Category for sports and outdoor activities',


            ],
        ];


        foreach ($categories as $item) {
            Category::updateOrCreate(
                ['slug' => Str::slug($item['name']) . '-' . Str::random(6),],
                $item
            );
        }
    }
}
