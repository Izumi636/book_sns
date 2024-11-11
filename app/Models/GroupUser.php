<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $table = 'groups_users';
    protected $fillable = ['group_id', 'user_id'];

    public function groups(){
        return $this->belongsTo(Group::class);

    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
