<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddressChanged;

class AddressController extends Controller
{
    public function edit()
    {
        $address = Address::firstOrNew(['user_id' => Auth::id()]);
        return view('address.edit', compact('address'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        $address = Address::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'address_line' => $request->address_line,
                'city'         => $request->city,
                'province'     => $request->province,
                'postal_code'  => $request->postal_code,
            ]
        );

        // Notifikasi ke admin & super
        $admins = User::whereIn('role', ['admin', 'super'])->get();
        Notification::send($admins, new AddressChanged(Auth::user(), $address));

        return redirect()->back()->with('success', 'Alamat berhasil diperbarui.');
    }
}

