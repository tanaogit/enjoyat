@inject('formatService', 'App\View\Services\FormatService') {{-- 表示用に整形するためのservice --}}
<x-pages.template>
    <x-slot name="title">ご指定の条件に合う店舗一覧 - Enjoyat</x-slot>

    {{-- 詳細検索結果一覧 --}}
    <div class="w-3/4 mx-auto py-8 md:py-12">
        <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2 mb-2">ご指定の条件に合う店舗</h2>
        <div class="flex flex-wrap text-xs md:text-sm">
            @if (!empty(request()->pref))
                <p class="border-2 border-gray-300 p-2 m-1 rounded-xl">アクセス : {{ request()->pref . ' ' . request()->line . ' ' . request()->station }}</p>
            @endif
            @if (!empty(str_replace([' ', '　'], '', request()->freeword)) || request()->freeword === '0') {{-- スペースのみの場合は項目に出さない --}}
                <p class="border-2 border-gray-300 p-2 m-1 rounded-xl truncate">フリーワード : {{ request()->freeword }}</p>
            @endif
            @if (!is_null(request()->businessdays))
                <p class="border-2 border-gray-300 p-2 m-1 rounded-xl">営業日 : {{ implode(', ', $formatService->getDaysInJapanese(request()->businessdays)) }}</p>
            @endif
            @if (!empty(request()->evaluation))
                <p class="border-2 border-gray-300 p-2 m-1 rounded-xl">口コミの評価 : {{ request()->evaluation }}以上</p>
            @else
                <p class="border-2 border-gray-300 p-2 m-1 rounded-xl">口コミの評価 : 指定なし</p>
            @endif
            @if (!empty($payments))
                <p class="border-2 border-gray-300 p-2 m-1 rounded-xl">支払い方法 : {{ implode(', ', $payments) }}</p>
            @endif
            @if (!empty($formatService->getCouponCondition(request()->coupon)))
                <p class="border-2 border-gray-300 p-2 m-1 rounded-xl">クーポンの有無 : {{ $formatService->getCouponCondition(request()->coupon) }}</p>
            @endif
            @if (!empty($genres))
                <p class="border-2 border-gray-300 p-2 m-1 rounded-xl">ジャンル : {{ implode(', ', $genres) }}</p>
            @endif
        </div>

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
</x-pages.template>
