<x-pages.template>
    <x-slot name="title">Enjoyat</x-slot>

    {{-- ヘッダー --}}
    <x-organisms.header />

    {{-- 簡易検索欄 --}}
    <div class="w-3/4 py-8 md:py-20 mx-auto">
        <x-organisms.simple-search-panel :genres="$genres" :payments="$payments" />
    </div>

    {{-- 最新の店舗一覧 --}}
    <div class="w-3/4 mx-auto">
        <x-organisms.latest_stores :latests="$latests" />
    </div>

    {{-- 評価の高い店舗順 --}}
    <div class="w-3/4 mx-auto">
        <x-organisms.evaluation_stores :evaluations="$evaluations" />
    </div>

    {{-- 注目されているサブスク順--}}
    <div class="w-3/4 mx-auto">
        <x-organisms.bookmark_products :bookmarks="$bookmarks" />
    </div>

    {{-- ページ上部に戻るボタン --}}
    <x-atoms.buttons.scroll-top-button />

    {{-- フッター --}}
    <x-organisms.footer />

    {{-- デバイス情報 --}}
    <input type="hidden" id="browser" value={{ $browser }}>

    <x-slot name="jsFile">
        <script src="{{ mix('js/index.js') }}"></script>
    </x-slot>
</x-pages.template>
