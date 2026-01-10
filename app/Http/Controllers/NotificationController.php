<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;

class NotificationController extends Controller
{
    public function sendNotifications(Request $request)
    {
        Notification::create($request->all());
    }
}
