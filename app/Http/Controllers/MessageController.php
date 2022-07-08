<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function list($factor)
    {
        $messages = Message::all()->where('factor', '=', $factor);
        return view('message', [
            'factor' => $factor,
            'messages' => $messages
        ]);
    }

    public function text(Request $request)
    {
        $this->validate($request, [
            'factor' => 'required',
            'text' => 'required',
        ]);

        $factor = $request->factor;
        $message = new Message();
        $message->factor = $factor;
        $message->user = 0;
        if (Auth::user()->access == 3) $message->user = Auth::id();
        $message->file = 0;
        $message->content = $request->text;
        $message->view = 0;
        $message->save();
        return redirect("/factor/message/$factor");
    }

}
