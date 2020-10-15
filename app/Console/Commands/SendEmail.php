<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    protected $signature = 'emails:send';

    protected $description = 'Sending emails to the users.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $data = ['name' => 'xxx'];
       Mail::send('mail.test', $data, function ($message) {

            $message->from('noresponder@ejornal.com.ar');

            $message->to('vdjkelly@ejornal.com.ar')->subject('Prueba de mail');

        });
        $this->info('The emails are send successfully!');
    }
}
