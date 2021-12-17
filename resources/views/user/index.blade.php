<x-pages.template>
    <x-slot name="title">ユーザーのダッシュボード - Enjoyat</x-slot>

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
    <x-organisms.user.header />

    {{-- ページ上部に戻るボタン --}}
    <x-atoms.buttons.scroll-top-button />

    {{-- フッター --}}
    <x-organisms.footer />

    {{-- デバイス情報 --}}
    {{-- <input type="hidden" id="browser" value={{ $browser }}> --}}

    <x-slot name="jsFile">
        <script src="{{ mix('js/user/index.js') }}"></script>
    </x-slot>
</x-pages.template>