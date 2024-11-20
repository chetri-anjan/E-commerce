<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Ensure this import
use App\Mail\WelcomeEmail;

class EmailController extends Controller
{
    public function sendWelcomeEmail()
    {
        $toMail ="chetrrianjan@gmail.com";
        $message ="Your order is recieved";
        $subject = "Order Shipped";

        $response = Mail::to($toMail)->send(new WelcomeEmail($message, $subject));
        
    }
}
