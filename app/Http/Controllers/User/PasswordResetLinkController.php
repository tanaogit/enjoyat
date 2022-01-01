<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * パスワードリセット申請用の画面を表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.forgot-password'); //View側に合わせて飛び先変更の可能性あり
    }

    /**
     * 入力されたメールアドレスをチェック、
     * 問題がなければパスワードリセットを申請したユーザーにメールを送信し、
     * 正常に送信できたかをチェック
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        //メールアドレスをチェックし、メール送信
        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        //送信結果
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __('passwords.user')]);
    }
}
