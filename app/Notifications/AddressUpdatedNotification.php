<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AddressUpdatedNotification extends Notification
{
    use Queueable;

    public $user;
    public $address;

    public function __construct(User $user, Address $address)
    {
        $this->user = $user;
        $this->address = $address;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // Atau tambahkan 'mail' jika ingin juga kirim email
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Perubahan Alamat Pengguna',
            'message' => "Perusahaan {$this->user->name} telah memperbarui alamatnya.",
            'address' => [
                'Alamat'     => $this->address->address_line,
                'Kota'       => $this->address->city,
                'Provinsi'   => $this->address->province,
                'Kode Pos'   => $this->address->postal_code,
            ]
        ];
    }
}
