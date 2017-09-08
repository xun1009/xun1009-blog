<?php

namespace App\Xun\Mailer;

use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer {
    protected function sendTo($data,$user,$template){

        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use($user) {
            $message->from(config('mail.from.address'), 'xun1009');
            $message->to($user->email);
        });
    }

}