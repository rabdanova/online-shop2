<?php

namespace App\Console\Commands;

use App\Http\Services\RabbitmqService;
use App\Mail\testMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class SignUpNotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sign-up-notify-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     */
    public function handle(RabbitmqService $rabbitmqService)
    {
        $callback = function ($msg) {
            $data = $msg->body;
            $data = json_decode($data, true);
            $user = User::query()->find($data['user_id']);

            Mail::to("lenovan32@gmail.com")->send(new testMail($data));
        };

       $rabbitmqService->consume('sign-up_email', $callback);
    }
}
