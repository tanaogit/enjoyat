@inject('formatService', 'App\View\Services\FormatService') {{-- 表示用に整形するためのservice --}}
<x-pages.template>
    <x-slot name="title">{{ $store->name }} - Enjoyat</x-slot>

    {{-- 店舗画像 --}}
    <img src="{{ $store->image }}" alt="{{ $store->name }}の画像" class="h-48 md:h-64 w-full object-cover">

    {{-- 店舗名と最寄りの駅など --}}
    <div class="mx-auto py-4 md:py-8 lg:py-10 w-11/12 md:w-4/5 lg:w-3/4">
        <h1 class="font-bold text-3xl">{{ $store->name }}</h1>
        @if ($store->accesses()->exists() && !empty($store->accesses->first()->prefecture))
            <p class="pt-1 md:pt-2 lg:pt-4">
                <i class="fas fa-map-marker-alt text-red-500"></i>
                {{ $store->accesses->first()->prefecture }}
                {{ $store->accesses->first()->line }}
                @if (!empty($store->accesses->first()->station_name))
                    {{ $store->accesses->first()->station_name }}駅
                @endif
                @if (!empty($store->accesses->first()->walking_time))
                    {{ $store->accesses->first()->walking_time }}分
                @endif
            </p>
        @endif
    </div>

    {{-- 店舗説明文 --}}
    @if (!empty($store->introduction))
        <div class="py-4 md:py-8">
            <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
                <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">店舗の紹介</h2>
                <p id="store-introduction" class="mt-4 md:mt-6 lg:mt-8">{{ $store->introduction }}</p>
                <button id="store-introduction-button" type="button" class="mt-1 md:mt-2 text-blue-600 hidden">もっと見る</button>
            </div>
        </div>
    @endif

    {{-- 写真 --}}
    <div class="py-4 md:py-8">
        <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">写真</h2>
                <a href="#" class="text-blue-600">すべて見る<i class="fas fa-chevron-right text-gray-500 ml-2 text-sm"></i></a> {{-- リンク先を変える --}}
            </div>
            @if ($store->storeimages()->exists())
                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-0.5 mt-4 md:mt-6 lg:mt-8">
                    @foreach ($store->storeimages as $storeimage)
                        <img src="{{ $storeimage->image }}" alt="{{ $store->name }}の画像">
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 md:py-12 lg:py-16">
                    <p>登録されている写真はありません。</p>
                </div>
            @endif
        </div>
    </div>

    {{-- 店舗情報 --}}
    <div id="store-info" class="pt-4 md:py-8">
        <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
            <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">店舗情報</h2>
        </div>
        <table class="mx-auto w-11/12 md:w-4/5 lg:w-3/4 mt-2 md:mt-3 lg:mt-6">
            <tbody>
                <tr class="border-gray-100 border-b-2">
                    <th class="w-1/3 py-4 md:py-5 lg:py-6">住所</th>
                    <td class="w-2/3 p-4 md:p-5 lg:p-6">
                        <p>
                            @if (!empty($store->zipcode))
                                〒{{ $store->zipcode }}
                            @else
                                -
                            @endif
                        </p>
                        <p>
                            @if (!empty($store->prefecture))
                                {{ $store->prefecture }}{{ $store->city }}{{ $store->street_address }}
                            @else
                                -
                            @endif
                        </p>
                    </td>
                </tr>
                <tr class="border-gray-100 border-b-2">
                    <th class="w-1/3 py-4 md:py-5 lg:py-6">アクセス</th>
                    <td class="w-2/3 p-4 md:p-5 lg:p-6">
                        @if ($store->accesses()->exists())
                            @foreach ($store->accesses as $access)
                                <p>
                                    {{ $access->prefecture }}
                                    {{ $access->line }}
                                    @if (!empty($access->station_name))
                                        {{ $access->station_name }}駅
                                    @endif
                                    @if (!empty($access->walking_time))
                                        {{ $access->walking_time }}分
                                    @endif
                                </p>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr class="border-gray-100 border-b-2">
                    <th class="w-1/3 py-4 md:py-5 lg:py-6">電話番号</th>
                    <td class="w-2/3 p-4 md:p-5 lg:p-6">
                        @if (!empty($store->tel))
                            <a href="tel:{{ $store->tel }}" class="text-blue-600 md:text-black md:pointer-events-none">{{ $store->tel }}</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr class="border-gray-100 border-b-2">
                    <th class="w-1/3 py-4 md:py-5 lg:py-6">営業時間</th>
                    <td class="w-2/3 p-4 md:p-5 lg:p-6">
                        @if (!empty($store->business_time))
                            {!! nl2br(e($store->business_time)) !!}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr class="border-gray-100 border-b-2">
                    <th class="w-1/3 py-4 md:py-5 lg:py-6">定休日</th>
                    <td class="w-2/3 p-4 md:p-5 lg:p-6">
                        @if ($store->holidays()->exists())
                            @php
                                // storeに紐づくholidaysのレコードは常に一つだけ
                                $holidays = $formatService->getDaysInJapanese($formatService->getHolidayColumns($store->holidays->toArray()[0]));
                                // holidaysの配列の各要素から「曜日」の文字を消す
                                $shortenedHolidays = array_map(function($holiday) {
                                    return str_replace('曜日', '', $holiday);
                                }, $holidays);
                            @endphp
                            @if (!empty($shortenedHolidays))
                                {{ implode('・', $shortenedHolidays) }}
                            @else
                                なし
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-1/3 py-4 md:py-5 lg:py-6">支払い方法</th>
                    <td class="w-2/3 p-4 md:p-5 lg:p-6">
                        @if ($store->payments()->exists())
                            @foreach ($store->payments as $payment)
                                @if (!$loop->last)
                                    {{ $payment->method }},
                                @else
                                    {{ $payment->method }}
                                @endif
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- 口コミ --}}
    <div class="py-4 md:py-8">
        <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">口コミ</h2>
                <a href="#" class="text-blue-600">すべて見る<i class="fas fa-chevron-right text-gray-500 ml-2 text-sm"></i></a> {{-- リンク先を変える --}}
            </div>
            @if ($store->posts()->exists())
                @foreach ($store->posts as $post)
                    <div class="mt-4 md:mt-8 lg:mt-10">
                        <h3 class="truncate font-bold">
                            {{ $post->title }}
                            <span class="font-normal"><i class="text-yellow-500 fas fa-star"></i> {{ number_format($post->eva_average, 1) }}</span>
                        </h3>
                        {{-- 2行を超える場合は「...」(三点リーダー)で省略 --}}
                        <p style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;">{{ $post->message }}</p>
                        <span class="text-gray-500 text-sm">({{ $post->created_at->diffForHumans() }})</span>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8 md:py-12 lg:py-16">
                    <p>口コミはありません。</p>
                </div>
            @endif
        </div>
    </div>

    {{-- 最新のサブスク --}}
    @if ($store->products()->exists())
        <div class="border-b-2 py-4 md:py-8">
            <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
                <div class="flex justify-between">
                    <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">最新のサブスク</h2>
                    <a href="#" class="text-blue-600">すべて見る<i class="fas fa-chevron-right text-gray-500 ml-2 text-sm"></i></a> {{-- リンク先を変える --}}
                </div>
                <ul class="md:grid md:grid-cols-2 lg:grid-cols-3 md:mt-8 lg:mt-10">
                    @foreach ($store->products as $product)
                    <li class="m-3 border-gray-100 border-2 hover:border-gray-300 hover:border-2 active:border-blue-300 cursor-pointer">
                        <a href="{{ route('index.productdetail', ['id' => $product->id]) }}">
                            <div class="relative h-48 rounded overflow-hidden border-gray-100 border-b-2">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}の画像" class="object-cover object-center w-full h-full block">
                            </div>
                            <div class="p-4">
                                <h3 class="text-gray-900 text-xl truncate">{{ $product->name }}</h3>
                                <div class="flex justify-between mt-1">
                                    <span class="text-gray-500 text-sm">
                                        {{ $product->price }}円<br>
                                        @php
                                            $unitprice = '-';
                                            if (!empty($product->unitprice)) {
                                                $unitprice = $product->unitprice;
                                            }
                                        @endphp
                                        (1回あたり{{ $unitprice }}円)
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <x-slot name="jsFile">
        <script src="{{ mix('js/storedetail.js') }}"></script>
    </x-slot>
</x-pages.template>
