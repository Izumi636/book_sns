<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    private $group;
    private $user;

    public function __construct(Group $group, User $user)
    {
        $this->group = $group;
        $this->user = $user;

    }

    public function index(){
        $groups = $this->group->latest()->get();

        return view('users.groups.index')->with('groups', $groups);
    }

    public function create(){
        
        return view('users.groups.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:1|max:100',
            'description'=>'required|min:1|max:500',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        $this->group->name = $request->name;
        $this->group->description = $request->description;
        $this->group->image  = 'data:image/' . $request->image->extension() . ';base64,' .base64_encode(file_get_contents($request->image));
        $this->group->user_id = Auth::user()->id;
        $this->group->save();

        return redirect()->route('groups.index');
        
    }

    public function show($id){
        $group = $this->group->findOrFail($id);
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.groups.show')->with('group', $group)->with('user', $user);
    }

    public function edit(Request $request, $id){
        $request->validate([
            'name'=>'required|min:1|max:100',
            'description'=>'required|min:1|max:500',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1048'
        ]);
        $group = $this->group->findOrFail($id);
        $group->name = $request->name;
        $group->description = $request->description;
        
        if($request->image){
            $group->image = 'data:image/' . $request->image->extension() . ';base64,' .base64_encode(file_get_contents($request->image));
        }

        $group->save();

        return redirect()->route('groups.show');

    }

    public function delete($id){
        $group = $this->group->findOrFail($id);
        $group->delete();

        return redirect()->route('groups.index');
    }
    public function join($id){
        $this->group->group_id = $id;
        $this->group->user_id = Auth::user()->id;
        $this->group->save();

        return redirect()->back();

    }
}
