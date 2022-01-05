<x-pages.template>
    <x-slot name="title">ユーザー新規登録 - Enjoyat</x-slot>
    
    {{-- ヘッダー --}}
    <x-organisms.header />

    {{-- 新規登録フォーム --}}
    <div class="lg:flex lg:justify-around mt-6 lg:mt-12 w-4/5 mx-auto">
        {{-- メールアドレスで新規登録 --}}
        <div class="select-none lg:w-5/12 max-w-md mx-auto">
            <h1 class="font-bold"><span class="border-l-4 border-pink-400 pl-2"></span>メールアドレスで新規登録</h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('user.register') }}" id="register-form">
                @csrf
                <div class="mt-4">
                    <label>
                        <div class="flex justify-between">
                            <p>メールアドレス<span class="text-red-500 text-xl md:text-2xl">*</span></p>
                            <span class="text-red-500 ml-1 text-sm">*は必須項目です。</span>
                        </div>
                        <div>
                            <input id="email" type="email" name="email" placeholder="enjoyat@example.com" value="{{ old('email') }}" class="w-full" required autofocus inputmode="email">
                            @error('email')
                                <span id="email_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                            @enderror
                        </div>
                    </label>
                </div>
                <div class="mt-4">
                    <label>
                        <p>
                            パスワード<span class="text-red-500 text-xl md:text-2xl">*</span>
                            <i id="password-eye" class="fas fa-eye cursor-pointer ml-2" title="パスワードを表示する"></i>
                        </p>
                        <input id="password" type="password" name="password" placeholder="パスワードを入力してください。" minlength="8" maxlength="255" class="w-full" required autocomplete="new-password">
                    </label>
                </div>
                <div class="mt-4">
                    <label>
                        <p>
                            パスワード再入力<span class="text-red-500 text-xl md:text-2xl">*</span>
                            <i id="password_confirmation-eye" class="fas fa-eye cursor-pointer ml-2" title="パスワードを表示する"></i>
                        </p>
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="パスワードを再度入力してください。" class="w-full" minlength="8" maxlength="255" required>
                        @error('password')
                            <span id="password_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="mt-4">
                    <label>
                        <p>ユーザー名<span class="text-red-500 text-xl md:text-2xl">*</span></p>
                        <input id="username" type="text" name="username" placeholder="Enjoyat" value="{{ old('username') }}" class="w-full" required>
                        @error('username')
                            <span id="username_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="lg:flex lg:justify-between mt-4">
                    <x-atoms.buttons.pink-button content="新規登録" class="block text-white px-6 py-4 w-full lg:w-5/12 font-bold bg-pink-400 rounded-lg hover:bg-pink-500" />

                    <a href="{{ route('user.login') }}" class="block text-center mt-4 lg:mt-0 lg:w-6/12 px-8 py-4 text-sm font-bold rounded-lg border-gray-700 hover:border-gray-900 border-2 hover:bg-gray-100">
                        {{-- カラム落ちを回避するために画面幅がlg以上xl未満の時は2行にする --}}
                        <span class="lg:block xl:inline">アカウントを</span>お持ちの方
                    </a>
                </div>
            </form>
        </div>

        {{-- 他のサービスで新規登録 --}}
        <div class="lg:w-5/12 mt-6 lg:mt-0 max-w-md mx-auto">
            <h1 class="font-bold"><span class="border-l-4 border-pink-400 pl-2"></span>他のサービスで新規登録</h1>

            <a href="" class="flex items-center mt-4 lg:mt-6 w-full rounded-lg text-center bg-blue-400 hover:bg-blue-500 text-white px-4 py-3">
                <i class="fab fa-twitter w-1/5 text-2xl"></i>
                <p class="w-4/5">Twitterで新規登録</p>
            </a>
            <a href="" class="flex items-center mt-4 lg:mt-6 w-full rounded-lg text-center bg-blue-700 hover:bg-blue-800 text-white px-4 py-3">
                <i class="fab fa-facebook-f w-1/5 text-2xl"></i>
                <p class="w-4/5">Facebookで新規登録</p>
            </a>
            <a href="" class="flex items-center mt-4 lg:mt-6 w-full rounded-lg text-center bg-red-700 hover:bg-red-800 text-white px-4 py-3">
                <i class="fab fa-google w-1/5 text-2xl"></i>
                <p class="w-4/5">Googleで新規登録</p>
            </a>
        </div>
    </div>

    {{-- フッター --}}
    <div class="mt-6 lg:mt-12">
        <x-organisms.footer />
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/user/register.js') }}"></script>
    </x-slot>
</x-pages.template>
