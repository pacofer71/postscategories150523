<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        //Recuperamos el usuario que devuelve github
        $gitUser = Socialite::driver('github')->user();
        $usuario = User::updateOrCreate([
            'external_id' => $gitUser->id,
        ], [
            'name' => $gitUser->name,
            'email' => $gitUser->email,
            'external_token' => $gitUser->token,
            'external_refresh_token' => $gitUser->refreshToken,
            'external_provider' => 'github',

        ]);
        Auth::login($usuario);
        return redirect('dashboard');
    }
}
