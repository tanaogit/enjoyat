<x-pages.template>
    <x-slot name="title">最新の店舗一覧 - Enjoyat</x-slot>

    {{-- ヘッダー --}}
    <x-organisms.header />

    {{-- 最新の店舗一覧 --}}
    <div class="w-3/4 mx-auto py-8 md:py-12">
        <h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">最新の店舗一覧</h2>

        <section class="mt-8">
            <ul class="md:grid md:grid-cols-2 lg:grid-cols-3 -m-3">
                @foreach ($latests as $latest)
                <li class="m-3 border-gray-100 border-2 hover:border-gray-300 hover:border-2 active:border-blue-300 cursor-pointer">
                    <a href="{{ route('index.storedetail', ['id' => $latest->id]) }}">
                        <div class="relative h-48 rounded overflow-hidden border-gray-100 border-b-2">
                            <img src="{{ $latest->image }}" alt="{{ $latest->name }}の店舗画像" class="object-cover object-center w-full h-full block">
                        </div>
                        <div class="p-4">
                            <h4 class="text-gray-500 text-sm truncate">{{ $latest->prefecture }}{{ $latest->city }}{{ $latest->street_address }}</h4>
                            <h3 class="text-gray-900 text-xl truncate">{{ $latest->name }}</h3>
                            <div class="flex justify-between mt-1">
                                <p class="text-md">{{ $latest->tel }}</p>
                                <span class="text-md bg-red-500 py-0.5 px-2 text-white rounded-md">new</span>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </section>
        <div class="mt-8">
            {{ $latests->links() }}
        </div>
    </div>

    {{-- ページ上部に戻るボタン --}}
    <x-atoms.buttons.scroll-top-button />

    {{-- フッター --}}
    <x-organisms.footer />

    <x-slot name="jsFile">
        <script src="{{ mix('js/latests.js') }}"></script>
    </x-slot>
</x-pages.template>
