<x-pages.template>
    <x-slot name="title">Enjoyat</x-slot>

    <header class="flex bg-gray-100 h-20 md:h-24">
        <div class="mx-auto w-10/12 md:w-11/12 flex justify-between">
            <div>
                <h1 style="line-height: 5rem" class="z-20 text-pink-400 font-mono fixed w-full text-4xl md:text-6xl"><a id="a" href={{ route('index') }}>Enjoyat</a></h1>
            </div>

            {{-- SP版の表示 --}}
            <button id="pagesTemplateHumburgerMenus" class="z-20 align-middle md:hidden w-6">
                <span class="pagesTemplateHumburgerMenu block mb-1.5 h-1 w-full rounded bg-black"></span>
                <span class="pagesTemplateHumburgerMenu block h-1 w-full rounded bg-black"></span>
                <span class="pagesTemplateHumburgerMenu block mt-1.5 h-1 w-full rounded bg-black"></span>
            </button>

            {{-- PC版の表示 --}}
            <div class="z-20 hidden md:block">
                <ul style="line-height: 4rem" class="flex">
                    {{-- 確認用(認証機能ができたときに消す) --}}
                    <li class="p-4 md:mr-1 lg:mr-2 cursor-pointer font-bold hover:bg-gray-300">
                        お店を探している方
                    </li>
                    <li class="p-4 cursor-pointer font-bold hover:bg-gray-300">
                        お店を登録したい方
                    </li>
                    {{-- 認証機能ができたときに作る --}}
                    {{-- <li class="p-4 mr-2 cursor-pointer font-bold">
                        @if (Route::has('user.login'))
                            @auth('users')
                                <a href="{{ route('user.dashboard') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500 underline">マイページへ</a>
                            @else
                                <a href="{{ route('user.login') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500">お店を探している方</a>
                            @endauth
                        @endif
                    </li>
                    <li class="p-4 cursor-pointer font-bold">
                        @if (Route::has('owner.login'))
                            @auth('owners')
                                <a href="{{ route('owner.dashboard') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500 underline">管理画面へ</a>
                            @else
                                <a href="{{ route('owner.login') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500">お店を登録したい方</a>
                            @endauth
                        @endif
                    </li> --}}
                </ul>
            </div>
        </div>
    </header>
    <div id="pagesTemplateSpMenus" class="hidden bg-gray-200 h-20">
        <ul class="text-center">
            {{-- 確認用(認証機能ができたときに消す) --}}
            <li class="pt-2 pb-2 hover:bg-gray-300">
                お店を探している方
            </li>
            <li class="pt-2 pb-2 hover:bg-gray-300">
                お店を登録したい方
            </li>
            {{-- 認証機能ができたときに作る --}}
            {{-- <li class="p-4 mr-2 cursor-pointer font-bold">
                @if (Route::has('user.login'))
                    @auth('users')
                        <a href="{{ route('user.dashboard') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500 underline">マイページへ</a>
                    @else
                        <a href="{{ route('user.login') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500">お店を探している方</a>
                    @endauth
                @endif
            </li>
            <li class="p-4 cursor-pointer font-bold">
                @if (Route::has('owner.login'))
                    @auth('owners')
                        <a href="{{ route('owner.dashboard') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500 underline">管理画面へ</a>
                    @else
                        <a href="{{ route('owner.login') }}" class="bg-red-300 hover:bg-red-500 rounded-lg p-5 text-sm text-gray-700 dark:text-gray-500">お店を登録したい方</a>
                    @endauth
                @endif
            </li> --}}
        </ul>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/index.js') }}"></script>
    </x-slot>
</x-pages.template>
