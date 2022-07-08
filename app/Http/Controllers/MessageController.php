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

    public function file(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads'),$imageName);

        $factor = $request->factor;
        $message = new Message();
        $message->factor = $factor;
        $message->user = 0;
        if (Auth::user()->access == 3) $message->user = Auth::id();
        $message->file = 1;
        $message->content = $imageName;
        $message->view = 0;
        $message->save();

        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        ImageUpload::where('filename',$filename)->delete();
        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

}
