<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $notification_count = $user->unreadNotifications->count();
        return response()->json(['count' => $notification_count]);
    }
}
