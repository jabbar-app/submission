<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'package_name' => 'required|string'
        ]);

        // Simpan data
        $notification = Notification::create($validated);
        Log::info('Notification received', $validated);

        return response()->json([
            'success' => true,
            'data' => $notification
        ]);
    }
}
