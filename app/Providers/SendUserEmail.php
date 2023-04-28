<?php

namespace App\Providers;

use App\Mail\SendProductCreated;
use App\Providers\ProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendUserEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductCreated $event): void
    {
        Mail::to($event->user)->send(new SendProductCreated($event->product));
    }
}
