<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Review;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $like;
    private $notification;
    private $review;

    public function __construct(Like $like, Notification $notification, Review $review)
    {
        $this->like = $like;
        $this->notification = $notification;
        $this->review = $review;

    }

    public function store($review_id){
        $this->like->user_id = Auth::user()->id;
        $this->like->review_id = $review_id;
        $this->like->save();

        // notification store
        $review = $this->review->findOrFail($review_id);

        $this->notification->user_id = Auth::user()->id;
        $this->notification->review_id = $review_id;
        $this->notification->owner_id = $review->user_id;
        $this->notification->save();
  
        

        return redirect()->back();
    }

    public function destroy($review_id){
        $this->like->where('user_id', Auth::user()->id)
        ->where('review_id', $review_id)
        ->delete();

        return redirect()->back();
    }

    public function notification(){
        $like = $this->like->get();

        return view('users.profiles.notification')->with('like', $like);
    }
}
