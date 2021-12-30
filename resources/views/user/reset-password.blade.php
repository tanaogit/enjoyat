<x-pages.template>
    <x-slot name="title">ユーザーパスワードリセット - Enjoyat</x-slot>

    <x-slot name="style">
        <style>
            .pagesTemplateTitle {
                    line-height: 5rem;
                }
            @media(min-width: 768px) {
                .pagesTemplateTitle {
                    line-height: 6rem;
                }
            }
        </style>
    </x-slot>

    {{-- ヘッダー --}}
    <x-organisms.header />

    {{-- パスワードリセットフォーム --}}
    <div class="lg:flex lg:justify-around mt-8 lg:mt-12 w-4/5 mx-auto">
        <div class="select-none lg:w-5/12 max-w-md mx-auto">
            <h1 id="password-reset-heading" class="font-bold"><span class="border-l-4 border-pink-400 pl-2"></span>パスワードリセット</h1>
            @error('token')
                <div class="mt-4">
                    <span id="email_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                </div>
            @enderror
            @error('email')
                <div class="mt-4">
                    <span id="email_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                </div>
            @enderror

            <form method="POST" action="{{ route('user.password.update') }}">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mt-4">
                    <div id="email-area">
                        <p>メールアドレス</p>
                        <p id="display-email" class="mt-1 ml-1">{{ $request->email }}</p>
                    </div>
                    <input id="hidden-email" name="email" type="hidden" value="{{ $request->email }}">
                </div>
                <div class="mt-4">
                    <label>
                        <p>
                            変更後のパスワード
                            <i id="password-eye" class="fas fa-eye cursor-pointer ml-2" title="パスワードを表示する"></i>
                        </p>
                        <input id="password" type="password" name="password" placeholder="パスワードを入力してください。" minlength="8" maxlength="255" class="w-full" required autofocus autocomplete="new-password">
                    </label>
                </div>
                <div class="mt-4">
                    <label>
                        <p>
                            変更後のパスワード再入力
                            <i id="password_confirmation-eye" class="fas fa-eye cursor-pointer ml-2" title="パスワードを表示する"></i>
                        </p>
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="パスワードを再度入力してください。" class="w-full" minlength="8" maxlength="255" required>
                        @error('password')
                            <span id="password_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="mt-12">
                    <x-atoms.buttons.pink-button id="reset-password-button" content="パスワードをリセットする" class="block mx-auto text-white px-6 py-4 w-full lg:w-2/3 font-bold bg-pink-400 rounded-lg hover:bg-pink-500" />
                </div>
            </form>
        </div>
    </div>

    {{-- フッター --}}
    <div class="mt-24 lg:mt-24">
        <x-organisms.footer />
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/user/reset-password.js') }}"></script>
    </x-slot>
</x-pages.template>
