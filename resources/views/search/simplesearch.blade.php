@inject('formatService', 'App\View\Services\FormatService') {{-- 表示用に整形するためのservice --}}
<x-pages.template>
    <x-slot name="title">
        {{ $formatService->getTitleForAccess(request()->pref, request()->line, request()->station) }} - Enjoyat
    </x-slot>

    {{-- ヘッダー --}}
    <x-organisms.header />

    {{-- 簡易検索結果一覧 --}}
    <div class="w-3/4 mx-auto py-8 md:py-12">
        <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">
            {{ $formatService->getTitleForAccess(request()->pref, request()->line, request()->station) }}
        </h2>

        <section class="mt-8">
            @if (!$search_stores->isEmpty())
                <ul class="md:grid md:grid-cols-2 lg:grid-cols-3 -m-3">
                    @foreach ($search_stores as $search_store)
                    <li class="m-3 border-gray-100 border-2 hover:border-gray-300 hover:border-2 active:border-blue-300 cursor-pointer">
                        <a href="{{ route('index.storedetail', ['id' => $search_store->id]) }}">
                            <div class="relative h-48 rounded overflow-hidden border-gray-100 border-b-2">
                                <img src="{{ asset($search_store->image) }}" alt="{{ $search_store->name }}の店舗画像" class="object-cover object-center w-full h-full block">
                            </div>
                            <div class="p-4">
                                <h4 class="text-gray-500 text-sm truncate">{{ $search_store->prefecture }}{{ $search_store->city }}{{ $search_store->street_address }}</h4>
                                <h3 class="text-gray-900 text-xl truncate">{{ $search_store->name }}</h3>
                                <div class="flex justify-between mt-1">
                                    <p class="text-md">{{ $search_store->tel }}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center mt-20 mb-36">
                    <p class="text-xl">
                        {{-- カラム落ち回避のためにmd未満では2行で表示 --}}
                        <span class="block md:inline">ご指定の条件に合う店舗は</span>見つかりませんでした。
                    </p>
                    <x-atoms.buttons.normal-button url="{{ route('index') }}" content="TOPページ戻る" class="inline-block mt-14" />
                </div>
            @endif
        </section>
        @if (!$search_stores->isEmpty())
            <div class="mt-8">
                {{ $search_stores->links() }}
            </div>
        @endif
    </div>

    {{-- ページ上部に戻るボタン --}}
    <x-atoms.buttons.scroll-top-button />

    {{-- フッター --}}
    <x-organisms.footer />

    <x-slot name="jsFile">
        <script src="{{ mix('js/search/simplesearch.js') }}"></script>
    </x-slot>
</x-pages.template>
