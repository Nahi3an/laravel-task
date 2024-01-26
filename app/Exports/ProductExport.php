<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $products = Product::with('category')->get(['name', 'slug', 'price', 'quantity', 'category_id']);
        return $products->map(function ($product) {
            return [
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'category' => $product->category->name ?? "Not Found",
            ];
        });
    }
    public function headings(): array
    {
        return ["name", "slug", "price", "quantity", "category"];
    }
}
