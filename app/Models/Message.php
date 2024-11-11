<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }

    public function recipient(){
        return $this->belongsTo(User::class,'recipient_id');
    }

    }

