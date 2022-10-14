<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Message;
use App\Models\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function user($id)
    {
        $messages = Message::all()->where('user', $id);
        $user = User::all()->find($id);

        $me = Auth::user();
        $access = $me->access;
        $userid = $me->id;

        if (in_array($access, [2, 3])) {
            Message::where('view', '0')
                ->where('user', $userid)
                ->where('sender', '0')
                ->update([
                    'view' => 1,
                ]);
        } else {
            Message::where('view', '0')
                ->where('user', $id)
                ->where('sender', $id)
                ->update([
                    'view' => 1,
                ]);
        }

        return view('message', [
            'user' => $user,
            'messages' => $messages
        ]);
    }

    public function list($factor, $detail = 0)
    {
        if ($detail)
            $messages = Message::all()->where('detail', $detail);
        else
            $messages = Message::all()->where('factor', $factor)->where('detail', 0);

        return view('message', [
            'factor' => $factor,
            'detail' => $detail,
            'messages' => $messages
        ]);
    }

    public function text(Request $request)
    {
        $this->validate($request, [
            'factor' => 'required',
            'detail' => 'required',
            'text' => 'required',
        ]);

        $factor = $request->factor;
        $detail = $request->detail;

        if (in_array(Auth::user()->access, [0, 1])) $user = $request->user;
        else $user = Auth::id();

        if (in_array(Auth::user()->access, [0, 1])) $sender = 0;
        else $sender = Auth::id();

        $message = new Message();
        $message->factor = $factor;
        $message->detail = $detail;
        $message->sender = $sender;
        $message->user = $user;
        $message->file = 0;
        $message->content = $request->text;
        $message->view = 0;
        $message->save();

        return redirect()->back();

        if ($detail)
            return redirect("/factor/message/$factor/$detail");
        else
            return redirect("/factor/message/$factor");
    }

    public function file(Request $request)
    {
        $user = $request->user;

        $path = public_path("../uploads");
        if (!file_exists($path)) mkdir($path);

        $image = $request->file('file');
        $imageName = $user . "-" . Verta()->format(" Y-m-d H-i-s ") . $image->getClientOriginalName();
        $image->move($path, $imageName);

        if (in_array(Auth::user()->access, [0, 1])) $user = $request->user;
        else $user = Auth::id();

        if (in_array(Auth::user()->access, [0, 1])) $sender = 0;
        else $sender = Auth::id();

        $message = new Message();
        $message->factor = 0;
        $message->detail = 0;
        $message->sender = $sender;
        $message->user = $user;
        $message->file = 1;
        $message->content = $imageName;
        $message->view = 0;
        $message->save();

        return response()->json(['success' => $imageName]);
    }

    public function fileDestroy(Request $request)
    {
        $filename = $request->get('filename');
        ImageUpload::where('filename', $filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function unread_counter()
    {
        $user = Auth::user();
        $access = (int)$user->access;
        $id = $user->id;
        $count = 0;

        if (in_array($access, [2, 3])) {
            $count = Message::all()
                ->where('view', '0')
                ->where('user', $id)
                ->where('sender', '0')
                ->count();
        } else {
            $count = DB::table('messages')
                ->join('users', 'users.id', 'messages.user')
                ->where('view', '0')
                ->where('sender', '!=', '0')
                ->where(function ($query) use ($id) {
                    $query->where('users.access', '2')
                        ->orWhere('users.adder', $id);
                })
                ->get()
                ->count();
        }

        return $count;
    }

    public function unread()
    {
        $user = Auth::user();
        $access = (int)$user->access;
        $id = $user->id;

        $users = DB::table('messages')
            ->distinct()
            ->select('users.*')
            ->join('users', 'users.id', 'messages.user')
            ->where('view', 0)
            ->where('sender', '!=', '0')
            ->where(function ($query) use ($id) {
                $query->where('users.access', '2')
                    ->orWhere('users.adder', $id);
            })
            ->get();

        return view('unread', ['users' => $users]);
    }

}
