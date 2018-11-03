<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'=>'required|unique:users'
        ]);

        $user = User::create(compact($validated));
        return $user;
    }

    public function show(int $id)
    {
        $user = User::find($id);
        return $user;
    }

    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->password = $request->password;        
        $user->highscore = $request->highscore;        
        $user->tries = $request->tries;        
        $user->save();
        return $user;
    }

    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(null, 204);        
    }

    public function login(Request $request) {
        return User::where([
            'username' => $request->username,
            'password' => $request->password,
        ])->get()->first();
    }
}
