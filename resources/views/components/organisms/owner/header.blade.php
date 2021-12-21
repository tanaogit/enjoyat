<header class="flex bg-gray-100 h-20 md:h-24">
    <div class="mx-auto w-10/12 md:w-11/12 flex justify-between">
        {{-- Enjoyatのロゴ --}}
        <x-atoms.service-logo />

        {{-- SP表示におけるハンバーガメニュー --}}
        <x-atoms.hamburger-menu />

        {{-- PC表示におけるメニュー --}}
        <div class="z-20 hidden md:block">
            <x-atoms.owner.pc-header-menu />
        </div>
    </div>
</header>
{{-- SP表示におけるメニュー(ハンバーガーメニュークリック時に表示) --}}
<div id="pagesTemplateSpMenus" class="hidden bg-gray-200 text-center">
    <form method="POST" action="{{ route('owner.logout') }}" class="owner-logout-form">
        @csrf
        <button id="sp-owner-logout-button" class="hover:bg-gray-300 w-full" style="line-height: 50px">
            ログアウト
        </button>
    </form>
</div>
