<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Owner;
use App\Models\UserOauthProvider;
use App\Models\OwnerOauthProvider;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OAuthProviderCallbackController extends Controller
{
    /**
     * 認証後にOAuthプロバイダからのコールバックを受信し、
     * 受信した情報を元に適切なルートにログインする処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $login_page = $request->session()->get('login-page', 'no-page');

        if ($login_page === 'user-page') {
            try {
                $provider_user = Socialite::driver($request->provider)->user();
            } catch (Exception $ex_user) {
                return redirect()->route('user.login')->withErrors(['oauth' => __('oauth.failed')]);
            }

            if (is_null($provider_user->email) || $provider_user->email === '') {
                return redirect()->route('user.login')->withErrors(['oauth' => __('oauth.email.not')]);
            }

            $user = $this->findOrCreateUser($request->provider, $provider_user);

            if (is_null($user)) {
                return redirect()->route('user.login')->withErrors(['oauth' => __('oauth.email.duplicate')]);
            }

            Auth::guard('users')->login($user);
            return redirect(RouteServiceProvider::USER_HOME);
        } else if ($login_page === 'owner-page') {
            try {
                $provider_owner = Socialite::driver($request->provider)->user();
            } catch (Exception $ex_owner) {
                return redirect()->route('owner.login')->withErrors(['oauth' => __('oauth.failed')]);
            }

            if (is_null($provider_owner->email) || $provider_owner->email === '') {
                return redirect()->route('owner.login')->withErrors(['oauth' => __('oauth.email.not')]);
            }

            $owner = $this->findOrCreateOwner($request->provider, $provider_owner);

            if (is_null($owner)) {
                return redirect()->route('owner.login')->withErrors(['oauth' => __('oauth.email.duplicate')]);
            }

            Auth::guard('owners')->login($owner);
            return redirect(RouteServiceProvider::OWNER_HOME);
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * 1回目のソーシャルログインの場合はアカウントを新規作成し、
     * 2回目以降は登録されているアカウントを取得する処理
     * null:別の認証方法で既に同じEmailAddressが登録されている場合はnullを返す
     *
     * @param string $provider
     * @param \Laravel\Socialite\Contracts\User $provider_user
     * @return \App\Models\User
     */
    private function findOrCreateUser($provider, $provider_user)
    {
        $user_provider_account = UserOauthProvider::where('name', $provider)->where('provider_id', $provider_user->id)->first();

        if (!is_null($user_provider_account)) {
            $user_provider_account->update([
                'provider_token' => $provider_user->token,
                'provider_refresh_token' => $provider === 'twitter' ? $provider_user->tokenSecret : $provider_user->refreshToken,
            ]);

            return $user_provider_account->user;
        } else {
            if (!is_null(User::where('email', $provider_user->email)->first())) {
                return null;
            }

            $user = User::create([
                'username' => $provider_user->name,
                'email' => $provider_user->email,
                'password' => Hash::make(Str::random(20)),
                'social_login' => true,
            ]);
            
            $user->provider()->create([
                'name' => $provider,
                'provider_id' => $provider_user->id,
                'provider_token' => $provider_user->token,
                'provider_refresh_token' => $provider === 'twitter' ? $provider_user->tokenSecret : $provider_user->refreshToken,
            ]);
            
            return $user;
        }
    }

    /**
     * 1回目のソーシャルログインの場合はアカウントを新規作成し、
     * 2回目以降は登録されているアカウントを取得する処理
     * null:別の認証方法で既に同じEmailAddressが登録されている場合はnullを返す
     *
     * @param string $provider
     * @param \Laravel\Socialite\Contracts\User $provider_owner
     * @return \App\Models\Owner
     */
    private function findOrCreateOwner($provider, $provider_owner)
    {
        $owner_provider_account = OwnerOauthProvider::where('name', $provider)->where('provider_id', $provider_owner->id)->first();

        if (!is_null($owner_provider_account)) {
            $owner_provider_account->update([
                'provider_token' => $provider_owner->token,
                'provider_refresh_token' => $provider === 'twitter' ? $provider_owner->tokenSecret : $provider_owner->refreshToken,
            ]);
            
            return $owner_provider_account->owner;
        } else {
            if (!is_null(Owner::where('email', $provider_owner->email)->first())) {
                return null;
            }

            $owner = Owner::create([
                'name' => $provider_owner->name,
                'email' => $provider_owner->email,
                'password' => Hash::make(Str::random(20)),
                'social_login' => true,
            ]);
            
            $owner->provider()->create([
                'name' => $provider,
                'provider_id' => $provider_owner->id,
                'provider_token' => $provider_owner->token,
                'provider_refresh_token' => $provider === 'twitter' ? $provider_owner->tokenSecret : $provider_owner->refreshToken,
            ]);
            
            return $owner;
        }
    }
}
