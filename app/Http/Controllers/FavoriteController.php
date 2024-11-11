<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    private $favorite;

    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    public function store($book_id){
        $this->favorite->user_id = Auth::user()->id;
        $this->favorite->book_id = $book_id;
        $this->favorite->save();

        return redirect()->back();
    }

    public function destroy($book_id){
        $this->favorite->where('user_id', Auth::user()->id)
        ->where('book_id', $book_id)
        ->delete();

        return redirect()->back();
    }

}
