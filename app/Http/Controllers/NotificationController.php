<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    private $notification;

    const IS_NOT_READ = 0;
    const IS_READ = 1;

    public function __construct(Notification $notification)
    {
         $this->notification = $notification;
    }

    public function index(){
        // $notification = $this->notification;

        $notifications = $this->notification->latest()->get();
        $owner_notifications = [];

        foreach($notifications as $n){
            if($n->owner_id === Auth::user()->id){
                // if($n->is_read === 0){
                    $owner_notifications[] = $n;
                // }
            }
        }

        return view('users.profiles.notification')->with('owner_notifications', $owner_notifications);

    }

    public function setRead($id){
        $n = $this->notification->findOrFail($id);
        $n->is_read = self::IS_READ;

        $n->save();

        return redirect()->back();
    }


    public function setUnread($id){
        $n = $this->notification->findOrFail($id);
        $n->is_read = self::IS_NOT_READ;

        $n->save();

        return redirect()->back();
    }

    

    // public function store($review_id){
    //     // $this->notification->user_id = Auth::user()->id;
    //     // $this->notification->review_id = $review_id;
    //     // $this->notification->owner_id = 1;
    //     // $this->notification->save();

    //     return redirect()->back();
    // }
}

// Notifications Table should connected to the Likes Table:
// the user_id on your notifications table is the recipient of the notification.