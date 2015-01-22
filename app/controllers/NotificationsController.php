<?php

class NotificationsController extends BaseController
{
    public function checkNotification()
    {
        $notifications = Auth::user()->notifications()->unread()->get();
        foreach ($notifications as $notification)
        {
             $notification->is_read = 1;
            $notification->save();
        }
        return Redirect::back();
    }
} 