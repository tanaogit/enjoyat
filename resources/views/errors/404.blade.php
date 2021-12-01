<x-pages.template>
    <x-slot name="title">Not Found - Enjoyat</x-slot>

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

    <div style="max-width: 80%" class="mx-auto text-center my-20">
        <h1 class="font-mono text-pink-400 text-9xl">404</h1>
        <p class="mt-9 md:text-lg leading-6 md:leading-8">
            お探しのページは見つかりませんでした。<br>
            一時的にアクセスできない状況にあるか、<br>
            移動もしくは削除された可能性があります。
        </p>
        <div class="mt-16 md:mt-14 mb-8">
            <x-atoms.buttons.normal-button url="{{ route('index') }}" content="トップページに戻る" />
        </div>
    </div>

    {{-- フッター --}}
    <x-organisms.footer />
</x-pages.template>
