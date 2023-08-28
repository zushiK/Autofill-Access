<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Front\User;

class SocialiteController extends AuthController
{
    protected $provider;

    /**
     * Allocate method
     *
     * @param string $provider
     * @return void
     */
    public function callback($provider)
    {
        $this->provider = $provider;
        return $this->$provider();
    }

    /**
     * Google ログイン
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function google()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
        } catch (\Laravel\Socialite\Two\InvalidStateException $th) {
            report($th);
            return redirect(route("login"))
                ->with("error", "不正なアクセスです。再度ログインをしてください。");
        }

        $user = User::updateOrCreate([
            "provider" => $this->provider,
            'social_id' => $socialUser->id,
        ], [
            'social_id' => $socialUser->id,
            "provider" => $this->provider,
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            "avatar" => $socialUser->avatar,
            "avatar_original" => $socialUser->avatar_original,
        ]);
        Auth::login($user, true);

        return redirect($this->redirectTo);
    }
}
