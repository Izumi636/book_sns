<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private $review;
    private $book;
    private $author;
    private $category;


    public function __construct(Review $review, Book $book, Author $author, Category $category){
        $this->review=$review;
        $this->book = $book;
        $this->author = $author;
        $this->category = $category;
    }

    public function add($id){
        $book=$this->book->findOrFail($id);

        $all_categories = $this->category->all();
        $all_authors = $this->author->all();

        // get all category IDs of this post, save in an array
        $selected_categories = [];
        foreach($book->bookCategory as $book_category){
            $selected_categories[] = $book_category -> category_id;
        }
        $selected_authors = [];
        foreach($book->bookAuthor as $book_author){
            $selected_authors[] = $book_author -> author_id;
        }

        return view('reviews.add')->with('book', $book)
        ->with('all_categories', $all_categories)
        ->with('selected_categories', $selected_categories)
        ->with('all_authors', $all_authors)
        ->with('selected_authors', $selected_authors);

    }

    public function store(Request $request, $book_id){
        $request->validate([
            'body' => 'required|min:1|max:1000',
            'stars' => 'required'
        ]);
        $book = $this->book->findOrFail($book_id);

        $this->review->body = $request->body;
        $this->review->stars = $request->stars;
        $this->review->user_id = Auth::user()->id;
        $this->review->book_id = $book_id;
        $this->review->save();

        $book->review_count = $book->review_count+1;
        $book->save();

        return redirect()->route('home');
    }

    public function edit($id){
        $review=$this->review->with('book')->findOrFail($id);
        // $book=$review->book->with('bookCategory')->first();
        // dd($review);

        $all_categories = $this->category->all();
        $all_authors = $this->author->all();

        // if the auth user is not the owner of the post, redirect to homepage
        if(Auth::user()->id != $review->user->id){
            return redirect()->route('index');
        }

        // get all category IDs of this post, save in an array
        $selected_categories = [];
        foreach($review->book->bookCategory as $book_category){
            $selected_categories[] = $book_category -> category_id;
        }
        $selected_authors = [];
        foreach($review->book->bookAuthor as $book_author){
            $selected_authors[] = $book_author -> author_id;
        }

        return view('reviews.edit-review')
        ->with('review', $review)
        ->with('book', $review->book)
        ->with('all_categories', $all_categories)
        ->with('selected_categories', $selected_categories)
        ->with('all_authors', $all_authors)
        ->with('selected_authors', $selected_authors);
    }

    public function update(Request $request, $id){

        $request->validate([
            'body' => 'required|min:1|max:1000',
            'stars' => 'required'
        ]);

        $review=$this->review->with('book')->findOrFail($id);
        $review->body=$request->body;
        $review->stars=$request->stars;

        $review->save();

        return redirect()->route('home');

    }

    public function destroy($id){
        $review = $this->review->findOrFail($id);
        $review->delete();
        
        return redirect()->back();

    }

    public function show($id){
        $review=$this->review->findOrFail($id);

        return view('reviews.show')->with('review', $review);
    }

    public function getAll()
    {
        $all_reviews = $this->review->with(['book', 'user'])->latest()->get();

        $all_reviews = $this->getAllReviews();

        return view('reviews.all-reviews')->with('all_reviews', $all_reviews);
    }

    public function getAllReviews(){
        $all_reviews = $this->review->with(['book', 'user'])->latest()->get();

        $all_reviews = [];

        // foreach($all_reviews as $review){
        //     if(
        //         // $review->user->isFollowed() ||
        //          $review->user->id === Auth::user()->id){
        //         $home_reviews[] = $review ;
        //     }

        // }

        // return $home_reviews;
        // dd($all_reviews);

        return $all_reviews;
    }

    
    }
