<?php

namespace App\Http\Controllers;

use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupUserController extends Controller
{
    private $groupUser;

    public function __construct(GroupUser $groupUser){
        $this->groupUser = $groupUser;
    }

    public function join($id){

    $existingMembership = GroupUser::where('group_id', $id)
        ->where('user_id', Auth::user()->id)
        ->first();

    if (!$existingMembership) {
        $this->groupUser->group_id = $id;
        $this->groupUser->user_id = Auth::user()->id;
        $this->groupUser->save();
    }
            return redirect()->back();

    }

    public function leave($id){
        $this->groupUser->where('user_id', Auth::user()->id)
        ->where('group_id', $id)
        ->delete();

        return redirect()->back();

    }
}
