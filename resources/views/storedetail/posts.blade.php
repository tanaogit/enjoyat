<x-pages.template>
    <x-slot name="title">{{ $store->name }}の口コミ一覧 - {{ config('app.name') }}</x-slot>

    <div class="py-8 md:py-12">
        <div class="mx-auto w-11/12 md:w-4/5 lg:w-3/4">
            <h1 class="flex text-lg font-bold border-l-4 border-pink-400 pl-2">
                <a href="{{ route('index.storedetail', ['id' => $store->id]) }}" class="block truncate" style="max-width: 60%">
                    {{ $store->name }}
                </a>
                <span>
                    の口コミ一覧
                </span>
            </h1>

            {{-- 口コミ一覧 --}}
            @if ($posts->total() > 0)
                <div class="my-10">
                    @foreach ($posts as $post)
                        <hr>
                        <div class="my-4 md:my-6 lg:my-8">
                            <h3 class="post-title truncate font-bold">{{ $post->title }}</h3>
                            <p class="post-message mt-2 md:mt-3">
                                {{ $post->message }}
                            </p>
                            <button type="button" class="post-message-button text-blue-600 hidden">もっと見る</button>
                            <p class="mt-2 md:mt-3">
                                <i class="text-yellow-500 fas fa-star"></i> {{ number_format($post->eva_average, 1) }}
                                <span class="inline-block text-gray-500 text-sm ml-2">({{ $post->created_at->diffForHumans() }})</span>
                            </p>
                            <ul class="mt-1 list-none bg-yellow-50 flex justify-between text-xs md:text-sm md:w-4/5 lg:w-3/5">
                                <li>評価項目1:{{ $post->evaluation1 }}</li> {{-- ここ変える --}}
                                <li>評価項目2:{{ $post->evaluation2 }}</li> {{-- ここ変える --}}
                                <li>評価項目3:{{ $post->evaluation3 }}</li> {{-- ここ変える --}}
                                <li>評価項目4:{{ $post->evaluation4 }}</li> {{-- ここ変える --}}
                                <li>評価項目5:{{ $post->evaluation5 }}</li> {{-- ここ変える --}}
                            </ul>
                        </div>
                    @endforeach
                    <hr>
                </div>
                {{-- ぺジネーションのリンク --}}
                {{ $posts->links() }}
            @else
                <div class="text-center mt-28 mb-40 md:mb-56 lg:mb-40">
                    <p>口コミはありません。</p>
                </div>
            @endif
        </div>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/storedetail/posts.js') }}"></script>
    </x-slot>
</x-pages.template>
