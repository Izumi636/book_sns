<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    public function bookCategory(){
        return $this->hasMany(BookCategory::class);
    }

    public function bookAuthor(){
        return $this->hasMany(BookAuthor::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function isReviewed(){
        return $this->reviews()->where('user_id', Auth::user()->id)->exists();
    //     // Auth::user()->id is the follower_id
    //     // firstly, get all the followers of the user($this->followers()). Then, from the list, search for the auth user from the follower column(where('follower_di', auth::user()->id))

    }

    public function favorite(){
        return $this->hasMany(Favorite::class);
    }

    public function isFavorite(){
        return $this->favorite()->where('user_id', Auth::user()->id)->exists();

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function average_reviews(){
      return  $this->reviews->avg('stars');
    }

}
