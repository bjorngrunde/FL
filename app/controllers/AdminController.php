<?php

use Illuminate\Routing\Controller;
use Family\Notification\NotificationFetcher;
class AdminController extends BaseController
{
    public function index()
    {
        $fetcher = new NotificationFetcher(Auth::user());
        $notifications = $fetcher->take(15)->fetch();
        return View::make('admin.dashboard', ['notifications' => $notifications]);
    }
}