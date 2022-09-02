<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//use Illuminate\Support\Facades\Request

class UserController extends Controller
{
    public function index($access)
    {
        $users = User::all()->where('access', '=', $access);
        return view('user-list', ['users' => $users, 'access' => $access]);
    }

    public function add($access, $id = null)
    {
        $user = null;
        if ($id) $user = User::find($id);
        return view('user', ['id' => $id, 'user' => $user, 'access' => $access]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'phone' => 'required|unique:users',
            'password' => 'required',
            'access' => 'required',
        ]);

        $user = new User();
        $access = $request->access;
        $user->name = $request->name;
        $user->family = $request->family;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->access = $request->access;
        $user->token =Str::random(100);
        $user->save();

        return redirect("/user/list/$access")->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'family' => 'required',
            'phone' => "required|unique:users,phone,$id,id",
        ]);

        $user = User::find($id);
        $access = $request->access;
        $user->name = $request->name;
        $user->family = $request->family;
        $user->phone = $request->phone;
        if ($request->password)
            $user->password = Hash::make($request->password);
        $user->save();
        return redirect("/user/list/$access")->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function remove($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/user/list')->withErrors(['danger' => 'با موفقیت حذف شد .']);
    }

    public function user_counter()
    {
        return User::all()->where('access', 3)->count();
    }

    public function producer_counter()
    {
        return User::all()->where('access', 2)->count();
    }

    public function profile()
    {
        return view('profile');
    }

    public function profile_update(Request $request)
    {
        $id = Auth::id();

        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->family = $request->family;
        if ($request->password)
            $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/profile')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

}
