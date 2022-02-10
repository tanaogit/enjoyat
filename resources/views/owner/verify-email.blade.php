<x-pages.template>
    <x-slot name="title">オーナー会員登録受付画面 - {{ config('app.name') }}</x-slot>

    {{-- オーナー会員登録受付画面 --}}
    <div class="mt-12 md:mt-20 mb-20 md:mb-40">
        <div class="w-4/5 lg:w-5/12 max-w-md mx-auto">
            <h1 class="font-bold"><span class="border-l-4 border-pink-400 pl-2"></span>オーナー会員登録受付画面</h1>
            <div class="leading-6 md:leading-8 mt-8">
                <p>
                    ご入力いただいたメールアドレス宛に確認用のメールを送信致しました。
                </p>
                <p class="mt-4">
                    なお、万が一メールが届いていない場合などがございましたら、お手数ですが再度本ページ下部のボタンよりメールの再送信をお願い致します。
                </p>
            </div>

            <div class="mt-8">
                <form method="POST" action="{{ route('owner.verification.send') }}" id="resend-form">
                    @csrf
                    <div>
                        <x-atoms.buttons.pink-button content="メールを再送信する" id="resend-button" class="block text-white px-6 py-4 w-full lg:w-4/5 xl:w-9/12 lg:mx-auto" />
                    </div>
                </form>
            </div>
            <div class="mt-4">
                <form method="POST" action="{{ route('owner.logout') }}" id="owner-logout-form">
                    @csrf
                    <button type="submit" id="owner-logout-button" class="block px-6 py-4 border-gray-700 hover:text-gray-100 hover:bg-gray-600 font-bold border-2 rounded-lg w-full lg:w-4/5 xl:w-9/12 lg:mx-auto">ログアウト</button>
                </form>
            </div>
        </div>

        {{-- メール送信ボタン押下時に表示する確認ダイアログ --}}
        <div id="send-confirm-dialog" class="hidden">
            <div class="pt-2 pb-4">
                <p>メールを再送信してもよろしいですか？</p>
            </div>
        </div>

        {{-- メール送信中に表示するローディングアイコンのダイアログ --}}
        <div id="sending-dialog" class="text-center hidden">
            <div class="mx-12 sm:mx-32 mt-6 sm:mt-12 mb-6 sm:mb-12">
                <div class="text-6xl sm:text-8xl mb-6 sm:mb-12">
                    <i class="fas fa-sync opacity-70"></i>
                </div>
                <p class="text-lg sm:text-xl">メールを送信中です…</p>
            </div>
        </div>

        {{-- ログアウト確認ダイアログ --}}
        <div id="logout-confirm-dialog" class="hidden">
            <div class="pt-2 pb-4">
                <p>本当にログアウトしてもよろしいですか？</p>
            </div>
        </div>

        {{-- 送信に成功した時に表示するダイアログ --}}
        @if (session('status') === 'verification-link-sent')
            <div id="sent-dialog">
                <p>会員登録確認用のメールを再送信しました。</p>
            </div>
        @endif
    </div>
    <x-slot name="jsFile">
        <script src="{{ mix('js/owner/verify-email.js') }}"></script>
    </x-slot>
</x-pages.template>
