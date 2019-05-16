<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['workingTime'])->find($id);

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        if ($user->hasRole('Частный инвестор'))
            return view('users.chin.edit', compact('user'));
        elseif ($user->hasRole('Андеррайтер'))
            return view('users.underwriter.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->workingTime()->updateOrInsert(['user_id' => $id], $request->only(['from', 'to']));

        return redirect()->route('user.show', $id);
    }
}
