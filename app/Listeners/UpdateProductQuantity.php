<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductQuantity implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ProductPurchased $event)
    {
        $product = $event->product;

        $product->quantity -= 1;
        $product->save();
    }
}
