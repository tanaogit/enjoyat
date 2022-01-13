<?php

namespace App\Http\Controllers\Owner;

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
        return view('owner.forgot-password'); //View側に合わせて飛び先変更の可能性あり
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
        $status = Password::broker('owners')->sendResetLink(
            $request->only('email')
        );

        //送信結果
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        } elseif ($status === 'passwords.user') {
            return back()->withInput($request->only('email'))->withErrors(['email' => __('passwords.owner')]);
        } else {
            return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
        }
    }
}
