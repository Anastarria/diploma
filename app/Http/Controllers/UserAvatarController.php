<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{
    /**
     * Update the avatar for the user.
     *
     * @param  Request  $request
     * @return false|Response|string
     */

    public function update(Request $request)
    {
        $name = $request->file('path_to_avatar')->getClientOriginalName();

        Storage::putFileAs(
            'public/avatars', $request->file('path_to_avatar'), $name
        );


        $user = $request->user();
        $user->path_to_avatar = $name;
        $user->save();

        return redirect('/profile/edit');
    }

    public function delete(Request $request)
    {
        $user = $request->user();
        Storage::delete(
            'public/avatars/'.$user->path_to_avatar);
        $user->path_to_avatar = null;
        $user->save();

        return redirect('/profile/edit');
    }
}
