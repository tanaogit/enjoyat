<x-pages.template>
    <x-slot name="title">オーナーのダッシュボード - Enjoyat</x-slot>

    {{-- ヘッダー --}}
    <x-organisms.owner.header />

    {{-- ログアウト確認ダイアログ --}}
    <div id="logout-confirm-dialog">
        <div class="pt-2 pb-4">
            <p>本当にログアウトしてもよろしいですか？</p>
        </div>
    </div>

    {{-- ページ上部に戻るボタン --}}
    <x-atoms.buttons.scroll-top-button />

    {{-- フッター --}}
    <x-organisms.footer />

    {{-- デバイス情報 --}}
    {{-- <input type="hidden" id="browser" value={{ $browser }}> --}}

    <x-slot name="jsFile">
        <script src="{{ mix('js/owner/index.js') }}"></script>
    </x-slot>
</x-pages.template>
