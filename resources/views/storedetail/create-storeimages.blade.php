{{-- 画面幅md未満の時のみ --}}
<x-pages.template>
    <x-slot name="title">{{ $store->name }}の写真投稿 - {{ config('app.name') }}</x-slot>

    <div class="my-8 mx-auto" style="max-width: 720px">
        <div class="mx-auto w-11/12">
            <h1 class="flex text-lg font-bold border-l-4 border-pink-400 pl-2">
                <a href="{{ route('index.storedetail', ['id' => $store->id]) }}" class="block truncate" style="max-width: 60%">
                    {{ $store->name }}
                </a>
                <span>
                    の写真投稿
                </span>
            </h1>

            {{-- 写真投稿用フォーム --}}
            <div class="mt-8 text-center">
                <x-molecules.user-add-storeimages-form action="{{ route('storedetail.registerStoreimages') }}" formId="sm-register-storeimages-form" buttonId="sm-register-storeimages-button" storeId="{{ $store->id }}" />
            </div>
        </div>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/storedetail/create-storeimages.js') }}"></script>
    </x-slot>
</x-pages.template>
