<?php


namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController
{

    public function showProfile(Request $request): View
    {
       $user = $request->user();

       if (!$user) {
           header("Location: /");
           die();
       }

       return view('User.profile', [
           'user' => $user
       ]);

    }

    public function editProfilePage(Request $request): View
    {
        $user = $request->user();

        if (!$user) {
            header("Location: /");
            die();
        }

        return view('User.editProfilePage', [
            'user' => $user
        ]);
    }

    public function updateProfile(EditProfileRequest $request)
    {
        $userId = $request->user()->id;

        $user = User::query()
            ->where('id', '=', $userId)
            ->first();

        $validated = $request->validated();

        $user->name =  $validated['name'] ?? $user->name;
        $user->nickname =  $validated['nickname'] ?? $user->nickname;
        $user->password =  $validated['password'] ?? $user->password;
        $user->email =  $validated['email'] ?? $user->email;
        $user->path_to_avatar =  $validated['path_to_avatar'] ?? $user->path_to_avatar;

        $user->save();

//        return redirect('/profile/edit');

    }


}