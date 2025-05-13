<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AddressChanged extends Notification
{
    use Queueable;

    public $user;
    public $address;

    public function __construct($user, $address)
    {
        $this->user = $user;
        $this->address = $address;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'User ' . $this->user->name . ' telah memperbarui alamat.',
            'address' => $this->address,
        ];
    }
}