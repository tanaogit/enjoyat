<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * ログイン画面
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('owner.login'); //View側に合わせて飛び先変更の可能性あり
    }

    /**
     * ログイン処理
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        //ログイン認証試行
        $request->authenticate();

        //セッションを再生成
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::OWNER_HOME);
    }

    /**
     * ログアウト処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('owners')->logout();

        //セッションを無効化
        $request->session()->invalidate();

        //CSRFトークンの再生成
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
