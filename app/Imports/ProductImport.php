<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $categoryName = $row[3];


        $category = Category::where('name', $categoryName)->first();
        if ($category) {
            $categoryId = $category->id;
        } else {

            $categoryId = null;
        }
        return new Product([
            //

            'name' => $row[0],
            'quantity' => $row[1],
            'price' => $row[2],
            'category_id' => $categoryId,
        ]);
    }
}
