<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * 会員登録画面
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('owner.register'); //View側に合わせて飛び先変更の可能性あり
    }

    /**
     * 会員登録処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:255'],
        ]);

        $owner = Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($owner));

        Auth::guard('owners')->login($owner);

        return redirect(RouteServiceProvider::OWNER_HOME);
    }
}
