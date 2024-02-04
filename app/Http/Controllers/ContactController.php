<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;


class ContactController extends Controller
{
    public function send(Request $request)
    {
        $contact = $request->validate(
            [
                'Firstname'      => 'required|string|max:255',
                'Lastname'     => 'required|string|max:255' ,
                'Emailaddress'   => 'required|email',
                'content'   => 'required|string',
            ]
        );

        Message::create($contact);
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new MessageMail($contact));

        return 'data sent successfully';
    }
}
