<x-pages.template>
    <x-slot name="title">ユーザーパスワードリセット用メール送信 - Enjoyat</x-slot>

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
            /* ツールチップ */
            .ui-tooltip {
                width: 250px;
            }
        </style>
    </x-slot>

    {{-- ヘッダー --}}
    <x-organisms.header />

    {{-- パスワードリセット用のメール送信フォーム --}}
    <div class="mt-12 md:mt-20 w-4/5 mx-auto">
        <div class="select-none lg:w-5/12 max-w-md mx-auto">
            <h1 class="font-bold">
                <span class="border-l-4 border-pink-400 pl-2"></span>パスワードリセット用のメール送信
                <x-atoms.icons.question-icon id="question-icon" class="text-md" title="入力されたメールアドレス宛にパスワードリセット用のリンク付きのメールを送信します。" />
            </h1>

            {{-- 送信に成功した時に表示するダイアログ --}}
            @if (!empty(session('status')))
                <div id="sent-dialog">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('user.password.email') }}">
                @csrf
                <div class="mt-8 md:mt-16">
                    <label>
                        メールアドレス
                        <input id="email" type="email" name="email" placeholder="enjoyat@example.com" value="{{ old('email') }}" class="w-full" required autofocus inputmode="email">
                        @error('email')
                            <span id="email_validation" class="text-red-500 text-sm font-semibold">※ {{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="mt-14 md:mt-16">
                    <x-atoms.buttons.pink-button content="メールを送信する" class="block text-white px-6 py-4 w-full xl:w-5/12 lg:mx-auto font-bold bg-pink-400 rounded-lg hover:bg-pink-500" />
                </div>
                </div>
            </form>
        </div>
    </div>

    {{-- フッター --}}
    <div class="mt-52 md:mt-36">
        <x-organisms.footer />
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/user/forgot-password.js') }}"></script>
    </x-slot>
</x-pages.template>

