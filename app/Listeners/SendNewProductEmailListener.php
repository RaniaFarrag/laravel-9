<?php

namespace App\Listeners;

use App\Events\NewProductCreatedEvent;
use App\Mail\NewProductEmail;
use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendNewProductEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewProductCreatedEvent  $event
     * @return void
     */
    public function handle(NewProductCreatedEvent $event)
    {
        Mail::to(Auth::user()->email)->send(new NewProductEmail($event->product));
    }
}
