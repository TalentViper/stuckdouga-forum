<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Message;
use App\Models\ServiceOption;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $search = Message::paginate(10);
        return view('admin.message.index')->with([
            'search' => $search
        ]);
    }

    public function show($id) {
        // return view('admin.message.index');
    }

    public function remove($id) {
        // return view('admin.message.index');
    }

    public function deleteMessages(Request $request) {
        $messageIds = $request->input('messageIds');
        Message::whereIn('id', $messageIds)->delete();
        return response()->json(['success' => true]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'content' => 'required|string',
            'attach_file_path' => 'nullable|string',
        ]);

        $user = User::where('username', $request->username)->first();
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
            'attach_file_path' => $request->attach_file_path
        ]);

        return redirect()->route('accountmessage');
    }

    public function receiveMessages()
    {
        $messages = Message::where('receiver_id', Auth::id())->with('sender')->get();

        return response()->json(['messages' => $messages], 200);
    }

    public function openMessageForm(Request $request, $to_admin = null) {
        // echo "<pre>"; print_r($to_admin); exit;
        return view('frontend.account.send')->with([
            'to_admin' => $to_admin
        ]);
    }
}
