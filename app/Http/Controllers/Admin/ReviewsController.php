<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{
    private $review;

    public function __construct(Review $review){
        $this->review = $review;
    }

    public function index(){
        $all_reviews = $this->review
        ->withTrashed()
        ->latest()->paginate(5);

        return view('admin.reviews.index')->with('all_reviews', $all_reviews);
    }

    public function hide($id){
        $this->review->destroy($id);

        return redirect()->back();
    }

    public function unhide($id){
        $this->review->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
     

    }

}