@inject('formatService', 'App\View\Services\FormatService') {{-- 表示用に整形するためのservice --}}
<x-pages.template>
    <x-slot name="title">{{ $store->name }} - {{ config('app.name') }}</x-slot>

    {{-- 店舗画像 --}}
    <img src="{{ $store->image }}" alt="{{ $store->name }}の画像" class="h-48 md:h-64 w-full object-cover">

    {{-- 画面幅md以上における写真および口コミ投稿ボタン --}}
    <div class="hidden md:block mb-4 md:mt-8 lg:mt-10 mx-auto md:w-4/5 lg:w-3/4">
        <ul class="flex justify-end space-between">
            {{-- 写真用のボタン --}}
            <li>
                @auth('users')
                    <x-atoms.buttons.unlinked-normal-button buttonId="user-add-storeimages-button" class="px-10 py-4">
                        <i class="far fa-images mr-1"></i>写真を投稿
                    </x-atoms.buttons.unlinked-normal-button>
                @endauth
                @guest
                    <x-atoms.buttons.unlinked-normal-button buttonId="guest-add-storeimages-button" class="px-10 py-4">
                        <i class="far fa-images mr-1"></i>写真を投稿
                    </x-atoms.buttons.unlinked-normal-button>
                @endguest
            </li>

            {{-- 口コミ用のボタン --}}
            <li id="add-post-button-area" class="ml-4">
                @auth('users')
                    @if (empty($post_id))
                        {{-- まだ投稿をしていない場合 --}}
                        <x-atoms.buttons.unlinked-normal-button buttonId="user-add-post-button" class="px-8 py-4">
                            <i class="far fa-comments mr-1"></i>口コミを投稿
                        </x-atoms.buttons.unlinked-normal-button>
                    @else
                        {{-- すでに投稿をしている場合 --}}
                        <div class="select-none px-8 py-4 font-bold rounded-lg border-2 border-gray-700 text-white bg-gray-600">
                            <i class="far fa-comments mr-1"></i>口コミ投稿済
                        </div>
                    @endif
                @endauth
                @guest
                    <x-atoms.buttons.unlinked-normal-button buttonId="guest-add-post-button" class="px-8 py-4">
                        <i class="far fa-comments mr-1"></i>口コミを投稿
                    </x-atoms.buttons.unlinked-normal-button>
                @endguest
            </li>
        </ul>
    </div>

    {{-- 店舗名と最寄りの駅など --}}
    <div class="mx-auto py-4 md:py-0 w-11/12 md:w-4/5 lg:w-3/4">
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
                @if ($store->storeimages()->exists())
                    <a href="{{ route('storedetail.storeimages', ['id' => $store->id]) }}" class="text-blue-600">
                        すべて見る<i class="fas fa-chevron-right text-gray-500 ml-2 text-sm"></i>
                    </a>
                @endif
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
                @if ($store->posts()->exists())
                    <a href="{{ route('storedetail.posts', ['id' => $store->id]) }}" class="text-blue-600">
                        すべて見る<i class="fas fa-chevron-right text-gray-500 ml-2 text-sm"></i>
                    </a>
                @endif
            </div>
            @if ($store->posts()->exists())
                @foreach ($store->posts as $post)
                    <div class="mt-4 md:mt-8 lg:mt-10">
                        <h3 class="truncate font-bold">{{ $post->title }}</h3>
                        {{-- 2行を超える場合は「...」(三点リーダー)で省略 --}}
                        <p style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;" class="mt-2 mb-1">
                            {{ $post->message }}
                        </p>
                        <p>
                            <i class="text-yellow-500 fas fa-star"></i> {{ number_format($post->eva_average, 1) }}
                            <span class="inline-block text-gray-500 text-sm ml-2">({{ $post->created_at->diffForHumans() }})</span>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8 md:py-12 lg:py-16">
                    <p>口コミはありません。</p>
                </div>
            @endif

            {{-- 画面幅md未満の時の口コミ投稿ボタン --}}
            <div class="md:hidden my-8 text-center">
                @auth('users')
                    @if (empty($post_id))
                        {{-- まだ投稿をしていない場合 --}}
                        <a href="{{ route('storedetail.createPost', ['user_id' => Auth::id(), 'store_id' => $store->id]) }}" class="block font-bold rounded-lg border-2 border-gray-700 hover:text-gray-100 hover:bg-gray-600 px-8 py-4">
                            <i class="fas fa-plus-circle mr-1"></i>口コミを投稿する
                        </a>
                    @else
                        {{-- すでに投稿をしている場合 --}}
                        <div class="select-none px-8 py-4 font-bold rounded-lg border-2 border-gray-700 text-white bg-gray-600">
                            <i class="fas fa-plus-circle mr-1"></i>口コミ投稿済
                        </div>
                    @endif
                @endauth
                @guest
                    <x-atoms.buttons.unlinked-normal-button buttonId="sm-guest-add-post-button" class="w-full px-8 py-4">
                        <i class="fas fa-plus-circle mr-1"></i>口コミを投稿する
                    </x-atoms.buttons.unlinked-normal-button>
                @endguest
            </div>
        </div>
    </div>

    {{-- 最新のサブスク --}}
    @if ($store->products()->exists())
        <div class="border-b-2 py-4 md:py-8">
            <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
                <div class="flex justify-between">
                    <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">最新のサブスク</h2>
                    <a href="{{ route('storedetail.products', ['id' => $store->id]) }}" class="text-blue-600">
                        すべて見る<i class="fas fa-chevron-right text-gray-500 ml-2 text-sm"></i>
                    </a>
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
                                        (1回あたり{{ !empty($product->unitprice) ? $product->unitprice : '-' }}円)
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

    {{-- ログインおよび新規登録用のダイアログ --}}
    <x-molecules.guest-login-register-dialog dialogId="guest-add-post-dialog" />

    {{-- 口コミ投稿用のダイアログ --}}
    <div id="user-add-post-dialog" style="min-width: 700px" class="hidden">
        <div class="pt-8 px-12">
            <x-molecules.user-add-post-form action="{{ route('storedetail.registerPostAjax') }}" formId="register-post-form" buttonId="register-post-button" userId="{{ Auth::id() }}" storeId="{{ $store->id }}" />
        </div>
    </div>

    {{-- 口コミ投稿完了時に表示するダイアログ --}}
    <div id="user-finish-post-dialog" class="hidden">
        <div class="py-12 px-16">
            <p id="user-finish-post-dialog-text"></p>
        </div>
    </div>

    {{-- 口コミ投稿画面から口コミを投稿した時 --}}
    @if (session('status') === 'success')
        <div id="sm-user-finish-post-dialog">
            <div class="p-4">
                <p>口コミを投稿しました。</p>
            </div>
        </div>
    @endif

    <x-slot name="jsFile">
        <script src="{{ mix('js/storedetail.js') }}"></script>
    </x-slot>
</x-pages.template>
