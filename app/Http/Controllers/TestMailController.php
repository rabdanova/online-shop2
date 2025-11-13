<?php

namespace App\Http\Controllers;

use App\Mail\testMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class TestMailController
{
    public function send()
    {
        $data = ['name' => 'Dimed'];

        Mail::to('lenovan32@gmail.com')->send(new testMail());

        echo "Mail sent successfully";
    }

    public function receive()
    {

    }
}
