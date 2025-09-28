<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $notification_count = $user->unreadNotifications->count();
        return response()->json(['count' => $notification_count]);
    }


    public function markAsRead(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $user->unreadNotifications->markAsRead();
        return response()->json(['status' => 'success']);
    }

    public function getNotifications()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $todayNotifications = $user->notifications()
            ->whereDate('created_at', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get();
        $yesterdayNotifications = $user->notifications()
            ->whereDate('created_at', now()->subDay()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get();
        return Inertia::render('Admin/Notification/List', [
            'notifications' => [
                'today' => $todayNotifications,
                'yesterday' => $yesterdayNotifications,
            ],
        ]);
    }
}
