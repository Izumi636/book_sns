<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, softDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reviews(){
        return $this->hasMany(Review::class)->latest();
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    public function following(){
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function isFollowed(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        // Auth::user()->id is the follower_id
        // firstly, get all the followers of the user($this->followers()). Then, from the list, search for the auth user from the follower column(where('follower_di', auth::user()->id))

    }
    public function sender(){
        return $this->hasMany(Message::class,'recipient_id');
    }

    public function recipient(){
        return $this->hasMany(Message::class,'sender_id');
    }


    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'owner_id');
    }

    public function notificationCounts(){
        return $this->notifications()->where('is_read', 0)->count();
    }

    public function messages(){
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function messagesend(){
        return $this->hasMany(Message::class, 'sender_id');
 
    }

    public function messagedelete(){
        return $this->hasMany(Message::class, 'deleted_at');
 
    }


    public function messagesCounts(){
        return $this->messages()->where('is_read', 0)->count();
    }

    public function books(){
        return $this->hasMany(Book::class);
    }

    public function messagesAllCounts(){
        return $this->messages()->count();
    }

    public function outboxCounts(){
        return $this->messagesend()->where('sender_id', Auth::user()->id)->count();
    }

    public function trashBoxCounts(){
        return $this->messages()->onlyTrashed()->count();
    }

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function groupUser(){
        return $this->hasMany(GroupUser::class, 'group_id');
    }

    // public function group_id()
    // {
    //     return $this->hasMany(Follow::class, 'following_id');
    // }

    // public function (){
    //     return $this->hasMany(Follow::class, 'follower_id');
    // }

    public function isJoined(){
        return $this->groupUser()->where('user_id', Auth::user()->id)->exists();
    }


}
