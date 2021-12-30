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
            } catch (Exception $ex) {
                return redirect()->route('user.login')->withErrors(['oauth' => '認証に失敗しました']);
            }

            $user = $this->findOrCreateUser($request->provider, $provider_user);

            Auth::login($user);
            return redirect(RouteServiceProvider::USER_HOME);
        } else if ($login_page === 'owner-page') {
            try {
                $provider_owner = Socialite::driver($request->provider)->user();
            } catch (Exception $ex) {
                return redirect()->route('owner.login')->withErrors(['oauth' => '認証に失敗しました']);
            }

            $owner = $this->findOrCreateOwner($request->provider, $provider_owner);

            Auth::login($owner);
            return redirect(RouteServiceProvider::OWNER_HOME);
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * ユーザーが登録されていれば取得し、なければ新規登録する処理
     *
     * @param [type] $provider
     * @param [type] $provider_user
     * @return void
     */
    private function findOrCreateUser($provider, $provider_user)
    {
        $social_account = UserOauthProvider::where('name', $provider)->where('provider_id', $provider_user->id)->first();

        if ($social_account) {
            $social_account->update([
                'provider_token' => $provider_user->token,
                'provider_refresh_token' => $provider_user->refreshToken,
            ]);

            return $social_account->user;
        } else {
            $user = User::where('email', $provider_user->email)->first();
        
            if (is_null($user)) {
                $user = User::create([
                    'username' => $provider_user->name,
                    'email' => $provider_user->email,
                    'password' => Hash::make(Str::random(20)),
                ]);
            }
        
            $user->providers()->create([
                'name' => $provider,
                'provider_id'   => $provider_user->id,
                'provider_token' => $provider_user->token,
                'provider_refresh_token' => $provider_user->refreshToken,
            ]);
        
            return $user;
        }
    }

    /**
     * オーナーが登録されていれば取得し、なければ新規登録する処理
     *
     * @param [type] $provider
     * @param [type] $provider_owner
     * @return void
     */
    private function findOrCreateOwner($provider, $provider_owner)
    {
        $social_account = OwnerOauthProvider::where('name', $provider)->where('provider_id', $provider_owner->id)->first();

        if ($social_account) {
            $social_account->update([
                'provider_token' => $provider_owner->token,
                'provider_refresh_token' => $provider_owner->refreshToken,
            ]);

            return $social_account->owner;
        } else {
            $owner = Owner::where('email', $provider_owner->email)->first();
        
            if (is_null($owner)) {
                $owner = Owner::create([
                    'name' => $provider_owner->name,
                    'email' => $provider_owner->email,
                    'password' => Hash::make(Str::random(20)),
                ]);
            }
        
            $owner->providers()->create([
                'name' => $provider,
                'provider_id'   => $provider_owner->id,
                'provider_token' => $provider_owner->token,
                'provider_refresh_token' => $provider_owner->refreshToken,
            ]);
        
            return $owner;
        }
    }
}
