<?php


namespace App\Http\Controllers;


use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Mail\PasswordResetLink;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationLinkEmail;
use Illuminate\Http\Request;


class AuthController
{
    public function showLoginForm(): View
    {
        return view('Auth.login');
    }

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();
        $unauthorized = User::query()
            ->where('email', $validated['email'])
            ->where('email_verified', 0)
            ->first();

        if ($unauthorized) {
            die("Check your email account for the validation link!");
        }

        $auth = Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        $user = User::query()
            ->where('email', $validated['email'])
            -> where('email_verified', 1)
            ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()
                ->json(['error' => "User not found or password is incorrect"], Response::HTTP_UNAUTHORIZED);
        }

        if ($auth) {
            Auth::login($user);
            session([
                'userName' => $user->name
            ]);
            return redirect('/');
        }
        die("Authorization failed");
    }

    public function showRegistrationForm(): View
    {
        return view('Auth.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()
            ->where('email', $validated['email'])
            ->first();

        if ($user) {
            return response()
                ->json(['error' => "User has been already registered, Please <a href='/login'>Login</a>"], Response::HTTP_UNAUTHORIZED);
        }


        $user = new User();
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->nickname = $validated['nickname'];
        $user->name = $validated['name'];
        $user->save();

        $uv = new UserVerification();
        $uv->user_id = $user->id;
        $uv->hash = md5(time() . $user->id);
        $uv->save();
//
        Mail::to($user)->send(new InvitationLinkEmail($uv->hash));

        return response()->json(['status' => true], Response::HTTP_CREATED);
    }

    public function logout(Request $request)
    {
        if ($user = $request->user()) {
            Auth::logout();
        }

        return redirect('/');
    }

    public function resetPass(EditProfileRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()
            ->where('email', $validated['email'])
            ->first();

        if (!$user) {
            return response()
                ->json(['error' => "Юзер с указанным адресом не найден. Перепроверьте введенные данные."], Response::HTTP_UNAUTHORIZED);
        }

        $reset = new PasswordReset();
        $reset->user_id = $user->id;
        $reset->hash = md5(time() . $user->id);
        $reset->save();

        Mail::to($user)->send(new PasswordResetLink($reset->hash));

        return response()->json(['status' => true], Response::HTTP_OK);
    }

    public function resetPassPage():View
    {
        return view('Auth.password_reset');
    }

    public function resetConfirmationPage(Request $request)
    {
        $hash = $request->input('hash');

        $reset = PasswordReset::query()
            ->where('hash', $hash)
            ->firstOrFail();

        $user = User::query()->where('id', $reset->user_id)->first();

        $reset->delete();

        return view('Auth.newPassword', [
            'user_email' => $user->email
        ]);
    }

    public function resetConfirmation(EditProfileRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()
            ->where('email', '=', $validated['email'])
            ->first();

        $user->password = Hash::make($validated['password']);
        $user->save();

        Auth::login($user);

        return redirect('/');
    }

}
