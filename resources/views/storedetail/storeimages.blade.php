<x-pages.template>
    <x-slot name="title">{{ $store->name }}の写真一覧 - {{ config('app.name') }}</x-slot>

    <div class="py-8 md:py-12">
        <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
            <h1 class="text-lg font-bold border-l-4 border-pink-400 pl-2">
                <a href="{{ route('index.storedetail', ['id' => $store->id]) }}">{{ $store->name }}</a>の写真一覧
            </h1>

            {{-- カテゴリ選択タブ --}}
            <ul class="list-none flex text-sm mx-auto mt-6 md:mt-8 lg:mt-10 max-w-md md:max-w-3xl">
                <li class="flex-grow flex-shrink text-center w-1/4">
                    @if (is_null($category))
                        <p class="rounded-tl-md rounded-bl-md py-2 md:py-4 font-semibold text-gray-100 bg-pink-400 border border-gray-700">すべて</p>
                    @else
                        <a href="{{ route('storedetail.storeimages', ['id' => $store->id]) }}"
                        class="rounded-tl-md rounded-bl-md block py-2 md:py-4 border border-gray-700 hover:text-gray-100 hover:bg-gray-600">すべて</a>
                    @endif
                </li>
                <li class="flex-grow flex-shrink text-center w-1/4">
                    @if ($category === 'foods')
                        <p class="py-2 md:py-4 font-semibold text-gray-100 bg-pink-400 border border-gray-700">料理</p>
                    @else
                        <a href="{{ route('storedetail.storeimages', ['id' => $store->id, 'category' => 'foods']) }}"
                        class="block py-2 md:py-4 border border-gray-700 hover:text-gray-100 hover:bg-gray-600">料理</a>
                    @endif
                </li>
                <li class="flex-grow flex-shrink text-center w-1/4">
                    @if ($category === 'drinks')
                        <p class="py-2 md:py-4 font-semibold text-gray-100 bg-pink-400 border border-gray-700">ドリンク</p>
                    @else
                        <a href="{{ route('storedetail.storeimages', ['id' => $store->id, 'category' => 'drinks']) }}"
                        class="block py-2 md:py-4 border border-gray-700 hover:text-gray-100 hover:bg-gray-600">ドリンク</a>
                    @endif
                </li>
                <li class="flex-grow flex-shrink text-center w-1/4">
                    @if ($category === 'others')
                        <p class="rounded-tr-md rounded-br-md py-2 md:py-4 font-semibold text-gray-100 bg-pink-400 border border-gray-700">その他</p>
                    @else
                        <a href="{{ route('storedetail.storeimages', ['id' => $store->id, 'category' => 'others']) }}"
                        class="rounded-tr-md rounded-br-md block py-2 md:py-4 border border-gray-700  hover:text-gray-100 hover:bg-gray-600">その他</a>
                    @endif
                </li>
            </ul>
        </div>

        {{-- 写真一覧 --}}
        @if ($storeimages->total() > 0)
            <div class="my-6 md:my-8 lg:mt-12">
                <div class="md:mx-auto md:w-4/5 lg:w-3/4">
                        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-0.5">
                            @foreach ($storeimages as $storeimage)
                                <div class="storeimage-area cursor-pointer overflow-hidden"
                                    data-storeimage-src="{{ asset($storeimage->image) }}"
                                    data-storeimage-created_at="{{ $storeimage->created_at->diffForHumans() }}">
                                    <img src="{{ asset($storeimage->image) }}" alt="{{ $store->name }}の写真" class="transform hover:scale-110">
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>

            {{-- ぺジネーションのリンク --}}
            <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
                {{ $storeimages->links() }}
            </div>

            {{-- 写真をクリック時に拡大して表示する --}}
            <div id="storeimage-dialog" class="hidden">
                <img id="storeimage-dialog-image" src="" alt="{{ $store->name }}の写真" class="mx-auto">
            </div>
        @else
            <div class="text-center mt-20 md:mt-28 mb-40 md:mb-56 lg:mb-40">
                <p>条件に合う写真はありません。</p>
            </div>
        @endif
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/storedetail/storeimages.js') }}"></script>
    </x-slot>
</x-pages.template>
