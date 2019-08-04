<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function index() {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function login() {
        return view('admin.login');
    }

    public function edit_user(User $user) {
        return view('admin.user.edit', compact('user'));
    }

    public function update_user(Request $request, User $user) {
        $this->validate($request, [
            'name' => 'string|required',
            'email' => 'email|required',
            'user_type' => 'string|required|in:admin,customer'
        ]);

        $user->email = $request->email;
        $user->name = $request->name;
        $user->active = $request->status == 'on' ? 1 : 0;
        $user->user_type = $request->user_type;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User Updated Successfully');
    }

    public function delete_user(User $user) {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User Deleted Successfully');
    }
}
