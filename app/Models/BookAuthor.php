<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;

    protected $table = 'book_author';
    protected $fillable = ['book_id', 'author_id'];

    public $timestamps = FALSE;

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function book(){
        return $this->belongsTo(Book::class, 'book_id');
    }

}
