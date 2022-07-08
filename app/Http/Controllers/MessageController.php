<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function list($factor) {
        return view('message', ['factor'=>$factor]);
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
        $message->file = 0;
        $message->content = $request->text;
        $message->view = 0;
        $message->save();
        return redirect("/factor/message/$factor");
    }

}
