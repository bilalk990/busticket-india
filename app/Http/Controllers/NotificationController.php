<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /** Mark a single notification as read (AJAX) */
    public function markRead(Request $request, $id)
    {
        $notif = Notification::forUser(Auth::id())->findOrFail($id);
        $notif->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }

    /** Mark all of the user's notifications as read */
    public function markAllRead()
    {
        Notification::forUser(Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back()->with('success', 'All notifications marked as read.');
    }
}
