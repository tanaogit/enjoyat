<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthRedirectToProviderController extends Controller
{
    /**
     * ログインフォームをセッションに保存し、
     * OAuthプロバイダにリダイレクトする処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->session()->put('login-page','owner-page');
        return Socialite::driver($request->provider)->redirect();
    }
}
