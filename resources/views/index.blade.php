<x-pages.template>
    <x-slot name="title">Enjoyat</x-slot>

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
    <x-organisms.header></x-organisms.header>

    {{-- SP表示におけるメニュー(ハンバーガーメニュークリック時に表示) --}}
    <div id="pagesTemplateSpMenus" class="hidden bg-gray-200 h-20">
        <ul class="text-center">
            {{-- 確認用(認証機能ができたときに消す) --}}
            <li class="pt-2 pb-2 hover:bg-gray-300">
                無料会員登録
            </li>
            <li class="pt-2 pb-2 hover:bg-gray-300">
                お店をお持ちの方はこちら
            </li>
            {{-- 認証機能ができたときに作る --}}
            {{-- <li class="p-4 mr-2 cursor-pointer font-bold">
                @if (Route::has('user.login'))
                    @auth('users')
                        <a href="{{ route('user.dashboard') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500 underline">マイページへ</a>
                    @else
                        <a href="{{ route('user.login') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500">無料会員登録</a>
                    @endauth
                @endif
            </li>
            <li class="p-4 cursor-pointer font-bold">
                @if (Route::has('owner.login'))
                    @auth('owners')
                        <a href="{{ route('owner.dashboard') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500 underline">店舗管理画面へ</a>
                    @else
                        <a href="{{ route('owner.login') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500">お店をお持ちの方</a>
                    @endauth
                @endif
            </li> --}}
        </ul>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/index.js') }}"></script>
    </x-slot>
</x-pages.template>
