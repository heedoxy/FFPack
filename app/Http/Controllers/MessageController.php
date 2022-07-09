<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Message;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function file(Request $request)
    {
        $factor = $request->factor;

        $code = Factor::find($factor)->code;
        $path = public_path("uploads");
        if (!file_exists($path)) mkdir($path);

        $image = $request->file('file');
        $imageName = $code . Verta()->format(" Y-m-d H-i-s ") . $image->getClientOriginalName();
        $image->move($path, $imageName);

        $factor = $request->factor;
        $message = new Message();
        $message->factor = $factor;
        $message->user = 0;
        if (Auth::user()->access == 3) $message->user = Auth::id();
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
