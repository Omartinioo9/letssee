<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {
    public function index() {
        $notifications = Notification::where('user_id', Auth::id())
                                      ->with('developer')
                                      ->get();

        return response()->json($notifications);
    }

    public function destroy($id) {
        $notification = Notification::where('id', $id)
                                    ->where('user_id', Auth::id())
                                    ->first();

        if ($notification) {
            $notification->delete();
            return response()->json(['message' => 'Notification deleted successfully']);
        }

        return response()->json(['message' => 'Notification not found'], 404);
    }
}
