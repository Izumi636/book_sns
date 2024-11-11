<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = FALSE;

    public function bookAuthor(){
        return $this->hasMany(BookAuthor::class);
    }
    
}
