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

    {{-- フッター --}}
    <x-organisms.footer></x-organisms.footer>

    <x-slot name="jsFile">
        <script src="{{ mix('js/index.js') }}"></script>
    </x-slot>
</x-pages.template>
