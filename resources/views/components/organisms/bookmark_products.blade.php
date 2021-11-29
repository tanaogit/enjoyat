<h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">注目されているサブスクはこちら</h2>

<section class="mt-8">
    <ul id="bookmark-products" class="md:grid md:grid-cols-2 lg:grid-cols-3 -m-3">
        @foreach ($bookmarks as $bookmark)
        <li class="m-3 border-gray-100 border-2 hover:border-gray-300 hover:border-2 active:border-blue-300 cursor-pointer">
            <a href="{{ route('index.productdetail', ['id' => $bookmark->id]) }}">
                <div class="relative h-48 rounded overflow-hidden border-gray-100 border-b-2">
                    <img src="{{ $bookmark->image }}" alt="{{ $bookmark->name }}の画像" class="object-cover object-center w-full h-full block">
                </div>
                <div class="p-4">
                    <h3 class="text-gray-900 text-xl truncate">{{ $bookmark->name }}</h3>
                    <div class="flex justify-between mt-1">
                        <span class="text-gray-500 text-sm">
                            {{ $bookmark->price }}円<br>
                            (1回あたり{{ $bookmark->unitprice }}円)
                        </span>
                        <span class="text-md font-bold text-red-500">注目</span>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</section>

<div class="text-center mt-14 md:mt-12 mb-10">
    <x-atoms.buttons.normal-button url="{{ route('index.bookmarks') }}" content="注目のサブスクをもっと見る" />
</div>
