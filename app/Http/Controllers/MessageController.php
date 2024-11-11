<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private $message;
    private $user;

    const IS_NOT_READ = 0;
    const IS_READ = 1;

    public function __construct(Message $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    public function index(){
        $message = $this->message->latest()->get();
        $recip_messages = [];
        foreach($message as $m){
            if($m->recipient_id === Auth::user()->id){
                // if($n->is_read === 0){
                    $recip_messages[] = $m;
                // }
            }
        }
        return view('users.profiles.messages.messages')->with('recip_messages', $recip_messages);
    }

    // public function add($user_id){
    //     $sender = Auth::user()->id;
    //     $recipient = $this->message->user->id;

    //     return view('users.profiles.messages.add-messages')->with('recipient', $recipient);

    // }

    public function add($user_id){
        $sender = Auth::user()->id;
        $recipient = $this->user->findOrFail($user_id);
        
        return view('users.profiles.messages.add-messages')->with('recipient', $recipient);

    }

    public function store(Request $request, $user_id){
        $request->validate([
            'title' => 'required|min:1|max:150',
            'message' => ' required|min:1|max:1000'
        ]);

        $recipient = $this->user->findOrFail($user_id);


        $this->message->title = $request->title;
        $this->message->message = $request->message;
        $this->message->sender_id = Auth::user()->id;
        $this->message->recipient_id  = $user_id;

        $this->message->save();

        return redirect()->route('home');
    }

    public function setRead($id){
        $m = $this->message->findOrFail($id);
        $m->is_read = self::IS_READ;

        $m->save();

        return redirect()->back();
    }


    public function setUnread($id){
        $m = $this->message->findOrFail($id);
        $m->is_read = self::IS_NOT_READ;

        $m->save();

        return redirect()->back();
    }

    public function outbox(){
        $message = $this->message->latest()->get();
        $send_messages = [];
        foreach($message as $m){
            if($m->sender_id === Auth::user()->id){
                // if($n->is_read === 0){
                    $send_messages[] = $m;
                // }
            }
        }
        return view('users.profiles.messages.outbox')->with('send_messages', $send_messages);
    }

    public function delete($id){
        $this->message->destroy($id);

        return redirect()->back();
    }

    public function trashBox(){
        $message = $this->message->onlyTrashed()->latest()->get();
        $trash_messages = [];
        foreach($message as $m){
            if($m->recipient_id === Auth::user()->id){
                    $trash_messages[] = $m;
           }
        }
        return view('users.profiles.messages.trashbox')->with('trash_messages', $trash_messages);
    }

    public function restore($id){
        $this->message->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();

    }

}
    
