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
    <x-organisms.header />

    {{-- 簡易検索欄 --}}
    <div class="w-3/4 py-8 md:py-20 mx-auto">
        <x-organisms.simple-search-panel :genres="$genres" :payments="$payments" />
    </div>

    {{-- 最新の店舗一覧 --}}
    <div class="w-3/4 mx-auto">
        <x-organisms.latest_stores :latests="$latests" />
    </div>

    {{-- フッター --}}
    <x-organisms.footer />

    <x-slot name="jsFile">
        <script src="{{ mix('js/index.js') }}"></script>
    </x-slot>
</x-pages.template>
