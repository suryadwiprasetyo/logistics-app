<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        return view('notifications.index', compact('notifications'));
    }

    public function show($id)
    {
    $notification = DatabaseNotification::where('id', $id)
        ->where('notifiable_id', Auth::id())
        ->firstOrFail();

    // Tandai sebagai dibaca jika belum
    if (is_null($notification->read_at)) {
        $notification->markAsRead();
        }

    return view('notifications.show', compact('notification'));
    }
}
