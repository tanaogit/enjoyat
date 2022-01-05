<header class="flex bg-gray-100 h-20 md:h-24">
    <div class="mx-auto w-10/12 md:w-11/12 flex justify-between">
        {{-- Enjoyatのロゴ --}}
        <x-atoms.service-logo class="h-20 md:h-24 w-1/2 md:w-10/12" />

        {{-- SP表示におけるハンバーガメニュー --}}
        <x-atoms.hamburger-menu />

        {{-- PC表示におけるメニュー --}}
        <div class="z-20 hidden md:block">
            <x-atoms.pc-header-menu />
        </div>
    </div>
</header>
{{-- SP表示におけるメニュー(ハンバーガーメニュークリック時に表示) --}}
<div id="pagesTemplateSpMenus" class="hidden bg-gray-200" style="height: 100px">
    <ul class="text-center">
        <li class="hover:bg-gray-300">
            @if (Route::has('user.login'))
                @auth('users')
                    <a href="{{ route('user.index') }}" class="block" style="line-height: 50px">マイページへ</a>
                @else
                    <a href="{{ route('user.login') }}" class="block" style="line-height: 50px">ログイン画面へ</a>
                @endauth
            @endif
        </li>
        <li class="hover:bg-gray-300">
            @if (Route::has('owner.login'))
                @auth('owners')
                    <a href="{{ route('owner.index') }}" class="block" style="line-height: 50px">店舗管理画面へ</a>
                @else
                    <a href="{{ route('owner.login') }}" class="block" style="line-height: 50px">お店をお持ちの方</a>
                @endauth
            @endif
        </li>
    </ul>
</div>
