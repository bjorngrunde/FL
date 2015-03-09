<?php

use Illuminate\Routing\Controller;
use Family\Notification\NotificationFetcher;
class AdminController extends BaseController
{
    public function index()
    {

        $notifications = Notification::where('Type', 'like', 'Admin%')->where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->take(10)->get();
        return View::make('admin.dashboard', ['notifications' => $notifications]);
    }
}