<?php

namespace App\Xun\Mailer;

class UserMailer extends Mailer{

    public function sendVerifyEmailTo($user){
        $data = [
            'name' => $user->name,
            'url' => route('email.verify', ['token' => $user->confirm_token])
        ];
        $template = config('xun.email_sendcloud_template');
        $this->sendTo($data,$user,$template);
    }
}