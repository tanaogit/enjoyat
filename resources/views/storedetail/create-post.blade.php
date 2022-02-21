{{-- 画面幅md未満の時のみ --}}
<x-pages.template>
    <x-slot name="title">{{ $store->name }}の口コミ投稿 - {{ config('app.name') }}</x-slot>

    <div class="py-8 mx-auto" style="max-width: 720px">
        <div class="mx-auto w-11/12">
            <h1 class="flex text-lg font-bold border-l-4 border-pink-400 pl-2">
                <a href="{{ route('index.storedetail', ['id' => $store->id]) }}" class="block truncate" style="max-width: 60%">
                    {{ $store->name }}
                </a>
                <span>
                    の口コミ投稿
                </span>
            </h1>

            {{-- クチコミ投稿用フォーム --}}
            <div class="mt-8">
                <x-molecules.user-add-post-form action="{{ route('storedetail.registerPost') }}" formId="register-post-form" buttonId="user-add-post-button" userId="{{ Auth::id() }}" storeId="{{ $store->id }}" :errors="$errors" />
            </div>
        </div>
    </div>
</x-pages.template>
