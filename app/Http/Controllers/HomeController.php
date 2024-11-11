<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $review;
    private $user;
    private $book;
    private $author;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Review $review, User $user, Book $book, Author $author)
    {
        $this->middleware('auth');
        $this->review = $review;
        $this->user = $user;
        $this->book = $book;
        $this->author = $author;


    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $home_reviews = $this->getHomeReviews();
        $suggested_books=$this->getSuggestedBooks();
        $popular_books=$this->getPopularBooks();

        

        return view('home')->with('home_reviews', $home_reviews)
        ->with('suggested_books', $suggested_books)
        ->with('popular_books', $popular_books);
    }

    public function getHomeReviews(){
        $all_reviews = $this->review->with(['book', 'user'])->latest()->get();

        $home_reviews = [];

        foreach($all_reviews as $review){
            if($review->user->isFollowed() || $review->user->id === Auth::user()->id){
                $home_reviews[] = $review ;
            }

        }
        return $home_reviews;
    }


    public function getAllReviews(){
        $all_reviews = $this->review->with(['book', 'user'])->latest()->get();

        $home_reviews = [];

        // foreach($all_reviews as $review){
        //     if(
        //         // $review->user->isFollowed() ||
        //          $review->user->id === Auth::user()->id){
        //         $home_reviews[] = $review ;
        //     }

        // }

        return $all_reviews;
    }

    public function allReviews()
    {

        $home_reviews = $this->getAllReviews();
        $suggested_users=$this->getSuggestedUsers();


        return view('reviews.all-reviews')->with('home_reviews', $home_reviews)->with('suggested_users', $suggested_users);
    }

    private function getSuggestedUsers(){
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user){
            if(!$user->isFollowed()){
                $suggested_users[] = $user;
            }
        }

        return array_slice($suggested_users, 0, 5);
        // array_slice(x, y, z)
        // x = array, y=offset/starting index, z = length/ how many
    }
    
    public function search(Request $request){
        $books = $this->book->where('title', 'like', '%'. $request->search . '%')->get();
        $authors = $this->author->where('name', 'like', '%' . $request->search . '%')->get();
        return view('search')
        ->with('books', $books)
        ->with('authors', $authors)
        ->with('search', $request->search);
    }

    private function getSuggestedBooks(){
        $all_books = $this->book->all();
        $suggested_books = [];

        foreach($all_books as $book){
            if(!$book->isReviewed()){
                $suggested_books[] = $book;
            }
        }
// need to fix so the reviewed books are
        return array_slice($suggested_books, 0, 3);
        // array_slice(x, y, z)
        // x = array, y=offset/starting index, z = length/ how many
    }

    private function getSuggestedAllBooks(){
        $all_books=$this->book->all();
        $suggested_all_books = [];

        foreach($all_books as $book){
            if(!$book->isReviewed()){
                $suggested_all_books[] = $book;
            }
        }

        return $suggested_all_books;
    }

    public function suggestion(){
        $suggested_all_books=$this->getSuggestedAllBooks();

        return view('books.suggestion')->with('suggested_all_books', $suggested_all_books);

    }

    public function getPopularBooks(){
        $popular_books=$this->book->orderByDesc('review_count')->take(5)->get();

        return  $popular_books;

    }

}
