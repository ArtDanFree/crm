<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\ProfileChangeAvatarRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.index');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = User::find(auth()->id())->update($request->all());
        return redirect('profile');
    }

    public function updateAvatar(ProfileChangeAvatarRequest $request)
    {
        $path = Helpers::updateAvatar($request->file('avatar'));
        User::find(\Auth::user()->id)->update(['avatar' => $path]);

        return response()->json([
            'src' => asset('storage/' . $path)
        ]);
    }
}
