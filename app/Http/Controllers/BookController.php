<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    private $book;
    private $author;
    private $category;
    private $user;
    private $review;
    


    public function __construct(Book $book, Author $author, Category $category, User $user, Review $review){
        $this->book = $book;
        $this->author = $author;
        $this->category = $category;
        $this->user = $user;
        $this->review = $review;
    }

    public function index(){
        $books = $this->book->latest()->get();
        $all_authors = $this->author->orderBy('name')->get();
        $all_categories = $this->category->orderBy('name')->get();

        // $stars = $this->calculation();
        // $average = array_sum($stars) / count($stars);

        return view('books.index')
            ->with('books', $books)
            ->with('all_authors', $all_authors)
            ->with('all_categories', $all_categories);
    }

    // public function calculation($id){
    //     // $reviews = $this->review->all();
    //     $book = $this->book->findOrFail($id);
    //     $stars = [];
    //     foreach($book->reviews as $review){
    //         $stars [] = $review->stars;
    //     }

    //     return $stars;


    //     $book_id = $this->review->book_id;
    //     $stars = $this->review->stars;

    //     $avg = $stars->sum($book_id)->avg();

    //     return $avg;
    // }
    

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:1|max:100',
            'cover_photo' => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'author_id' => 'required|array|between:1,5',
            'category_id' => 'required|array|between:1,3',
            'story' => 'required|min:1|max:500'
        ]);

        $this->book->title =$request->title;
        $this->book->cover_photo  = 'data:image/' . $request->cover_photo->extension() . ';base64,' .base64_encode(file_get_contents($request->cover_photo));
        $this->book->user_id = Auth::user()->id;
        $this->book->story = $request->story;
        $this->book->save();

        foreach($request->category_id as $category_id){
            $book_category[] = ['category_id' => $category_id];
        }
        $this->book->bookCategory()->createMany($book_category);


        foreach($request->author_id as $author_id){
            $book_author[] = ['author_id' => $author_id];
        }
        $this->book->bookAuthor()->createMany($book_author);

    
    
        return redirect()->route('books.index');

    }

    public function show($id){
        $book=$this->book->findOrFail($id);

        return view('books.show')->with('book', $book);

    }

    public function edit($id){
        $book=$this->book->findOrFail($id);
        $all_authors = $this->author->all();
        $all_categories = $this->category->all();


        return view('books.edit-book')
        ->with('book', $book)
        ->with('all_authors', $all_authors)
        ->with('all_categories', $all_categories);

    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|min:1|max:100',
            'cover_photo' => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'author_id' => 'required|array|between:1,5',
            'category_id' => 'required|array|between:1,3',
            'story' => 'required|min:1|max:500'

        ]);

        $book=$this->book->findOrFail($id);
        $book->title =$request->title;
        $book->story = $request->story;
        $book->user_id = Auth::user()->id;


        if($request->cover_photo){
            $book->cover_photo = 'data:image/' . $request->cover_photo->extension() . ';base64,' . base64_encode(file_get_contents($request->cover_photo));
        }
        
        $book->save();

        $book->bookCategory()->delete();
        foreach($request->category_id as $category_id){
            $book_category[] = ['category_id' => $category_id];
        }
        $book->bookCategory()->createMany($book_category);

        $book->bookAuthor()->delete();

        foreach($request->author_id as $author_id){
            $book_author[] = ['author_id' => $author_id];
        }
        $book->bookAuthor()->createMany($book_author);


        return redirect()->route('books.show', $id);

    }

    
    

}
