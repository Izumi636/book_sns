<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    private $book;
    
    public function __construct(Book $book)
    {
       $this->book = $book; 
    }

    public function index(){
        $all_books = $this->book
        ->withTrashed()
        ->latest()->paginate(5);

        return view('admin.books.index')->with('all_books', $all_books);
    }

    public function hide($id){
        $this->book->destroy($id);

        return redirect()->back();
    }

    public function unhide($id){
        $this->book->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
     
    }

}
