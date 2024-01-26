<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use App\Mail\NewProductCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProductEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewProductCreatedMail($this->product));
        }
    }
}
