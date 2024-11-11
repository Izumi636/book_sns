<?php

namespace App\Http\Controllers;

use App\Models\GroupComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupCommentController extends Controller
{
    private $groupComment;

    public function __construct(GroupComment $groupComment)
    {
        $this->groupComment = $groupComment;
    }

    public function store(Request $request, $group_id){
        $request->validate([
            'comment_body' => 'required|max:150'
        ],
    );

        $this->groupComment->body = $request->comment_body;
        $this->groupComment->user_id = Auth::user()->id;
        $this->groupComment->group_id = $group_id;
        $this->groupComment->save();

        return redirect()->back();
    }

    public function destroy($id){
        $this->groupComment->destroy($id);
        return redirect()->back();

    }
}
