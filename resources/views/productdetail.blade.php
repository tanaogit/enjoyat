<x-pages.template>
    <x-slot name="title">{{ $product->name }} - Enjoyat</x-slot>

    <x-slot name="headerOption">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </x-slot>

    {{-- サブスク画像 --}}
    <img src="{{ $product->image }}" alt="{{ $product->name }}の画像" class="h-48 md:h-64 w-full object-cover">

    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="bookmark-url" value="{{ route("productdetail.executeBookmark") }}">
    <input type="hidden" name="register-url" value="{{ route("productdetail.executeRegister") }}">

    {{-- サブスク名や価格など --}}
    <div class="mx-auto my-4 md:my-8 lg:my-10 w-11/12 md:w-4/5 lg:w-3/4">
        <div class="flex justify-between items-end">
            <h2 class="font-medium truncate" style="max-width: 60%">
                <i class="fas fa-store-alt text-pink-400"></i>
                <a href="{{ route('index.storedetail', ['id' => $product->store->id]) }}">
                    {{ $product->store->name }}
                </a>
            </h2>
            <ul class="flex items-center">
                {{-- bookmark用のボタン --}}
                <li id="bookmark-list" class="{{ (!empty($category) && $category[0] === 'register') ? 'hidden' : '' }}">
                    {{-- ログインユーザー --}}
                    @auth('users')
                        <x-molecules.user-bookmark-buttons :category="$category" />
                    @endauth
                    {{-- 未ログインユーザー --}}
                    @guest
                        <x-molecules.guest-bookmark-buttons />
                    @endguest
                </li>
                {{-- register用のボタン --}}
                <li>
                    {{-- ログインユーザー --}}
                    @auth('users')
                        <x-molecules.user-register-buttons :category="$category" />
                    @endauth
                    {{-- 未ログインユーザー --}}
                    @guest
                        <x-molecules.guest-register-buttons />
                    @endguest
                </li>
            </ul>
        </div>
        <h1 class="font-bold text-3xl pt-1 md:pt-2 lg:pt-4">{{ $product->name }}</h1>
        <p class="pt-1 md:pt-2 lg:pt-4 text-gray-500">
            <i class="fas fa-yen-sign text-yellow-400"></i> {{ $product->price }}円
            @if (!empty($product->unitprice))
                (1回あたり{{ $product->unitprice }}円)
            @endif
        </p>
        @if ($product->genres()->exists())
            <div class="flex flex-wrap text-xs md:text-sm mt-1 md:mt-2 lg:mt-4">
                @foreach ($product->genres as $genre)
                    <p class="border-2 border-gray-300 text-gray-600 p-2 m-1 rounded-xl">{{ $genre->name }}</p>
                @endforeach
            </div>
        @endif
    </div>

    {{-- サブスク説明文 --}}
    <div class="my-4 md:my-8">
        <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
            <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">サブスクの紹介</h2>
            @if (!empty($product->description))
                <p id="product-description" class="mt-4 md:mt-6 lg:mt-8">{{ $product->description }}</p>
                <button id="product-description-button" type="button" class="mt-1 md:mt-2 text-blue-600 hidden">もっと見る</button>
            @else
                <div class="text-center py-8 md:py-12 lg:py-16">
                    <p>紹介文はありません。</p>
                </div>
            @endif
        </div>
    </div>

    {{-- クーポン --}}
    @if ($product->coupons()->exists())
        <div class="mt-4 mb-12 md:mt-8 md:mb-12">
            <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
                <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">適用可能なクーポン</h2>
                <div class="text-center my-4 md:mt-8 lg:grid lg:grid-cols-2 gap-x-2">
                    @foreach ($product->coupons as $coupon)
                        <div class="border-2 border-gray-300 rounded-md mt-2 py-2 px-4">
                            <h3>{{ $coupon->name }}</h3>
                            <p class="mt-2" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3; overflow: hidden;">{{ $coupon->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div id="user-bookmark-register-dialog" class="hidden">
        <p id="user-bookmark-register-dialog-text" class="m-6 md:m-8 lg:m-10"></p>
    </div>

    <div id="guest-bookmark-register-dialog" class="hidden">
        <div class="pt-4 md:p-8 lg:mx-12">
            <p>本機能を利用するためにはログインが必要です。</p>
            <ul class="mx-auto text-center mt-8 w-4/5">
                <li>
                    <a href="{{ route('user.login') }}" target="_blank" rel="noopener noreferrer" class="block font-bold bg-pink-400 rounded-lg hover:bg-pink-500 py-4">
                        ログイン画面へ
                    </a>
                </li>
                <li class="mt-4">
                    <a href="{{ route('user.register') }}" target="_blank" rel="noopener noreferrer" class="block font-bold border-gray-700 hover:text-gray-100 hover:bg-gray-600 border-2 rounded-lg py-4">
                        新規登録画面へ
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/productdetail.js') }}"></script>
    </x-slot>
</x-pages.template>
