<x-pages.template>
    <x-slot name="title">ユーザーログイン - Enjoyat</x-slot>

    {{-- パスワードリセットに成功した時に表示するダイアログ --}}
    @if (!empty(session('status')))
        <div id="password-reset-dialog">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    {{-- ログインフォーム --}}
    <div class="lg:flex lg:justify-around mt-6 lg:mt-12 mb-6 lg:mb-12 w-4/5 mx-auto">
        {{-- メールアドレスでログイン --}}
        <div class="select-none lg:w-5/12 max-w-md mx-auto">
            <h1 class="font-bold"><span class="border-l-4 border-pink-400 pl-2"></span>メールアドレスでログイン</h1>

            <form method="POST" action="{{ route('user.login') }}" id="login-form">
                @csrf
                <div class="mt-4">
                    <label>
                        メールアドレス
                        <input id="email" type="email" name="email" placeholder="enjoyat@example.com" value="{{ old('email') }}" class="w-full" required autofocus inputmode="email">
                        @error('email')
                            <span id="email_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="mt-4">
                    <label>
                        パスワード
                        <i id="password-eye" class="fas fa-eye cursor-pointer ml-2" title="パスワードを表示する"></i>
                        <input id="password" type="password" name="password" placeholder="パスワードを入力してください。" minlength="8" maxlength="255" value="{{ old('password') }}" class="w-full" required autocomplete="current-password">
                        @error('password')
                            <span id="password_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="mt-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="cursor-pointer" name="remember">
                        <span class="ml-2 text-sm text-gray-600">ログイン状態を保持する</span>
                    </label>
                </div>

                <div class="lg:flex lg:justify-between mt-4">
                    <x-atoms.buttons.pink-button content="ログイン" class="block text-white px-6 py-4 w-full lg:w-5/12 font-bold bg-pink-400 rounded-lg hover:bg-pink-500" />

                    <a href="{{ route('user.register') }}" class="block text-center mt-4 lg:mt-0 lg:w-6/12 px-8 py-4 text-sm font-bold rounded-lg border-gray-700 hover:border-gray-900 border-2 hover:bg-gray-100">新規登録の方はこちら</a>
                </div>
            </form>

            @if (Route::has('user.password.request'))
                <div class="mt-6 text-center lg:text-left">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('user.password.request') }}">
                        パスワードをお忘れの方
                    </a>
                </div>
            @endif
        </div>

        {{-- 連携済みアカウントでログイン --}}
        <div class="lg:w-5/12 mt-6 lg:mt-0 max-w-md mx-auto">
            <h1 class="font-bold"><span class="border-l-4 border-pink-400 pl-2"></span>連携済みアカウントでログイン</h1>

            <a href="{{ route('user.social.redirect', ['provider' => 'twitter']) }}" class="flex items-center mt-4 lg:mt-6 w-full rounded-lg text-center bg-blue-400 hover:bg-blue-500 text-white px-4 py-3">
                <i class="fab fa-twitter w-1/5 text-2xl"></i>
                <p class="w-4/5">Twitterでログイン</p>
            </a>
            <a href="{{ route('user.social.redirect', ['provider' => 'facebook']) }}" class="flex items-center mt-4 lg:mt-6 w-full rounded-lg text-center bg-blue-700 hover:bg-blue-800 text-white px-4 py-3">
                <i class="fab fa-facebook-f w-1/5 text-2xl"></i>
                <p class="w-4/5">Facebookでログイン</p>
            </a>
            <a href="{{ route('user.social.redirect', ['provider' => 'google']) }}" class="flex items-center mt-4 lg:mt-6 w-full rounded-lg text-center bg-red-700 hover:bg-red-800 text-white px-4 py-3">
                <i class="fab fa-google w-1/5 text-2xl"></i>
                <p class="w-4/5">Googleでログイン</p>
            </a>
            @error('oauth')
                <div class="text-red-500 text-sm font-semibold mt-5">※ {{ $message }}</div>
            @enderror
        </div>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/user/login.js') }}"></script>
    </x-slot>
</x-pages.template>
