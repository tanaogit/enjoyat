<x-pages.template>
    <x-slot name="title">{{ $store->name }}のサブスク一覧 - {{ config('app.name') }}</x-slot>

    <div class="py-8 md:py-12">
        <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
            <h1 class="flex text-lg font-bold border-l-4 border-pink-400 pl-2">
                <a href="{{ route('index.storedetail', ['id' => $store->id]) }}" class="block truncate" style="max-width: 60%">
                    {{ $store->name }}
                </a>
                <span>
                    のサブスク一覧
                </span>
            </h1>

            {{-- サブスク一覧 --}}
            @if ($products->total() > 0)
                <ul class="md:grid md:grid-cols-2 lg:grid-cols-3 md:mt-8 lg:mt-10">
                    @foreach ($products as $product)
                        <li class="m-3 border-gray-100 border-2 hover:border-gray-300 hover:border-2 active:border-blue-300 cursor-pointer">
                            <a href="{{ route('index.productdetail', ['id' => $product->id]) }}">
                                <div class="relative h-48 rounded overflow-hidden border-gray-100 border-b-2">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}の画像" class="object-cover object-center w-full h-full block">
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
                {{-- ぺジネーションのリンク --}}
                {{ $products->links() }}
            @else
                <div class="text-center mt-28 mb-40 md:mb-56 lg:mb-40">
                    <p>サブスクはありません。</p>
                </div>
            @endif
        </div>
    </div>
</x-pages.template>
