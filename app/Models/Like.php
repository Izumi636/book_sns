<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function reviews(){
        return $this->belongsTo(Review::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
