<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;
    private $book;

    public function __construct(User $user, Book $book){
        $this->user = $user;
        $this->book=$book;
    }

    public function show($id){
        $user = $this->user->findOrFail($id);

        return view('users.profiles.show')->with('user', $user);
    }

    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profiles.edit')->with('user', $user);
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar' => 'mimes:jpg, jpeg, gif, png| max:1048',
            'introduction' => ' max:100'
        ]);

        $user=$this->user->findOrFail(Auth::user()->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->introduction=$request->introduction;

        if($request->avatar){
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        $user->save();

        return redirect()->route('profiles.show', Auth::user()->id);

    }

    public function followers($id){
        $user = $this->user->findOrFail($id);

        return view('users.profiles.followers')
        ->with('user', $user);
    }

    public function following($id){
        $user = $this->user->findOrFail($id);

        return view('users.profiles.following')
        ->with('user', $user);
    }

    public function favorite($id){
        $user = $this->user->findOrFail($id);
        // $book = $this->book->findOrFail($id);

        return view('users.profiles.favorite')
        ->with('user', $user);
        // ->with('book', $book);
    }

    public function added($id){
        $user = $this->user->findOrFail($id);
        // $book = $this->book->findOrFail($id);

        return view('users.profiles.added-books')
        ->with('user', $user);
        // ->with('book', $book);
    }



}
