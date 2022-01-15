<x-pages.template>
    <x-slot name="title">オーナーパスワードリセット用メール送信 - Enjoyat</x-slot>

    <x-slot name="style">
        <style>
            /* ツールチップ */
            .ui-tooltip {
                width: 250px;
            }
        </style>
    </x-slot>

    {{-- パスワードリセット用のメール送信フォーム --}}
    <div class="mt-12 md:mt-20 mb-52 md:mb-36 w-4/5 mx-auto">
        <div class="select-none lg:w-5/12 max-w-md mx-auto">
            <h1 class="font-bold">
                <span class="border-l-4 border-pink-400 pl-2"></span>パスワードリセット用のメール送信
                <x-atoms.icons.question-icon id="question-icon" class="text-md" title="入力されたメールアドレス宛にパスワードリセット用のリンク付きのメールを送信します。" />
            </h1>

            {{-- メール送信ボタン押下時に表示するローディングアイコンのダイアログ --}}
            <div id="sending-dialog" class="text-center">
                <div class="mx-12 sm:mx-32 mt-6 sm:mt-12 mb-6 sm:mb-12">
                    <div class="text-6xl sm:text-8xl mb-6 sm:mb-12">
                        <i class="fas fa-sync opacity-70"></i>
                    </div>
                    <p class="text-lg sm:text-xl">メールを送信中です…</p>
                </div>
            </div>

            {{-- 送信に成功した時に表示するダイアログ --}}
            @if (!empty(session('status')))
                <div id="sent-dialog">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('owner.password.email') }}">
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
                    <x-atoms.buttons.pink-button content="メールを送信する" id="send-main-button" class="block text-white px-6 py-4 w-full xl:w-5/12 lg:mx-auto font-bold bg-pink-400 rounded-lg hover:bg-pink-500" />
                </div>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/owner/forgot-password.js') }}"></script>
    </x-slot>
</x-pages.template>
