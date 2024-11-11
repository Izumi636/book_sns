<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function add(){

        $all_authors = $this->author->get();
        return view('books.add-author')
        ->with('all_authors', $all_authors);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:1|max:100'
        ]);

        $this->author->name = $request->name;
        $this->author->save();

        return redirect()->back();

    }

    public function destroy($id){
        $author = $this->author->findOrFail($id);
        $author->delete();
        
        return redirect()->back();

    }

    public function edit($id){
        // SELECT * FROM tasks WHERE id = $id
        $author=$this->author->findOrFail($id);
        return view('books.edit-author')->with('author',$author);
    }


    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required|min:3|max:100'
        ]);
        $author   =$this->author->findOrFail($id);
        $author->name =$request->name;
        $author->save();

        return redirect()->route('authors.add');
    }

}
