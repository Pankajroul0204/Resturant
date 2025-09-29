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

    public function getNotifications()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $todayNotifications = $user->notifications()
            ->whereDate('created_at', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get()->map(fn($n) => [
                'id' => $n->id,
                'data' => $n->data,
                'type' => $n->type,
                'read_at' => $n->read_at,
                'created_at' => $n->created_at->diffForHumans()
            ]);
        $yesterdayNotifications = $user->notifications()
            ->whereDate('created_at', now()->subDay()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get()->map(fn($n) => [
                'id' => $n->id,
                'data' => $n->data,
                'type' => $n->type,
                'read_at' => $n->read_at,
                'created_at' => $n->created_at->diffForHumans()
            ]);
        $olderNotifications = $user->notifications()
            ->whereDate('created_at', '<', now()->subDay()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get()->map(fn($n) => [
                'id' => $n->id,
                'data' => $n->data,
                'type' => $n->type,
                'read_at' => $n->read_at,
                'created_at' => $n->created_at->diffForHumans()
            ]);

        return Inertia::render('Admin/Notification/List', [
            'notifications' => [
                'today' => $todayNotifications,
                'yesterday' => $yesterdayNotifications,
                'older' => $olderNotifications,
            ],
        ]);
    }

    public function markAsRead($id)
    {
        $user = auth()->user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['status' => 1, 'msg' => 'Notification marked as read.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Notification not found.']);
        }
    }
}
