{{-- 各エラーページのテンプレート --}}
@props(['title' => '', 'statusCode' => '', 'errorText' => ''])
<x-pages.template>
    <x-slot name="title">{{ $title }} - {{ config('app.name') }}</x-slot>

    <div style="max-width: 80%" class="mx-auto text-center my-20">
        <h1 class="font-mono text-pink-400 text-9xl">{{ $statusCode }}</h1>
        <p class="mt-9 md:text-lg leading-6 md:leading-8">
            {{ $errorText }}
        </p>
        <div class="mt-16 md:mt-14 mb-8">
            <x-atoms.buttons.normal-button url="{{ route('index') }}" content="トップページに戻る" />
        </div>
    </div>
</x-pages.template>
