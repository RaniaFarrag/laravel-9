<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends BaseController
{
    public function sendWelcomeEmail()
    {
        Mail::to(Auth::user()->email)->send(new WelcomeEmail());

        return $this->sendResponse('Sent successfully');

    }
}
