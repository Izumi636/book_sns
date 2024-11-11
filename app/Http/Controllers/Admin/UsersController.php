<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $user;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;


    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        $all_users = $this->user->withTrashed()->latest()->paginate(5);

        return view('admin.users.index')->with('all_users', $all_users);
    }

    public function deactivate($id){
        $this->user->destroy($id);

        return redirect()->back();
    }

    // undelete soft deleted column back to Null
    public function activate($id){
        // onlyTrashed( retrieves soft deleted records only
        // restore() This will un-delete a soft deleted model. This will set the deleted_at column to null
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    public function setAdminRole($id){
        $user = $this->user->findOrFail($id);
        $user->role_id = self::ADMIN_ROLE_ID;

        $user->save();

        return redirect()->back();

    }

    public function setUserRole($id){
        $user = $this->user->findOrFail($id);
        $user->role_id = self::USER_ROLE_ID;

        $user->save();

        return redirect()->back();

    }

}
