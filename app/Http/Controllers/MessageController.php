<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Message;
use App\Models\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function user($id)
    {
        $messages = Message::all()->where('user', $id);
        $user = User::all()->find($id);

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
        $factor = $request->factor;

        $code = Factor::find($factor)->code;
        $path = public_path("../uploads");
        if (!file_exists($path)) mkdir($path);

        $image = $request->file('file');
        $imageName = $code . Verta()->format(" Y-m-d H-i-s ") . $image->getClientOriginalName();
        $image->move($path, $imageName);

        $factor = $request->factor;
        $detail = $request->detail;

        if (in_array(Auth::user()->access, [0, 1])) $user =0;
        else $user = Auth::id();

        $message = new Message();
        $message->factor = $factor;
        $message->detail = $detail;
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

}
