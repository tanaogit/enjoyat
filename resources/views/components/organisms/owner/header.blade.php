<header class="flex bg-gray-100 h-20 md:h-24">
    <div class="mx-auto w-10/12 md:w-11/12 flex justify-between">
        {{-- SP表示におけるハンバーガメニュー --}}
        <x-atoms.auth-hamburger-menu />

        {{-- SP表示におけるアイコン類 --}}
        <img id="header-owner-icon" src="storage/storeimages/default.png" alt="オーナーのアイコン" class="lg:hidden rounded-full overflow-hidden w-12 my-4 md:my-6 cursor-pointer"> {{-- 開発時要確認 --}}

        {{-- PC表示の時に店舗情報を表示 --}}
        <h2 class="hidden lg:block" style="line-height: 6rem"><a href="{{ route('owner.index') }}" class="font-bold">ABC店(住所)</a></h2>

        {{-- PC表示におけるメニュー --}}
        <div class="z-20 hidden lg:block">
            <x-atoms.owner.pc-header-menu />
        </div>
    </div>
</header>
{{-- SP表示におけるメニュー(ハンバーガーメニュークリック時に表示) --}}
<div id="pagesTemplateSpMenus" class="bg-gray-900 transform -translate-x-full duration-300 ease-in-out fixed top-0 left-0 z-20 w-3/4 md:w-1/2 select-none h-full">
    <nav>
        <x-atoms.service-logo divClass="my-8" class="h-12 mx-auto" />
        <ul class="text-gray-400">
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> ホーム</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あい</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいう</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえ</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえお</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえおか</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえおかき</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえおかきく</a></li>
        </ul>
    </nav>
</div>
{{-- アイコンクリック時に表示するメニュー --}}
<div id="header-owner-icon-menu" class="hidden shadow-2xl bg-white w-2/5 md:w-1/3 -mt-4 ml-auto absolute right-8 z-20">
    <a href="" class="block px-4 leading-10 hover:text-white hover:bg-gray-400"><i class="fas fa-cog"></i> 設定</a>
    <button id="sp-owner-changeStore-button" type="button" class="block w-full text-left leading-10 hover:text-white hover:bg-gray-400 px-4"><i class="fas fa-exchange-alt"></i> 店舗変更</button>
    <form method="POST" action="{{ route('owner.logout') }}" class="owner-logout-form">
        @csrf
        <button id="sp-owner-logout-button" class="block w-full text-left leading-10 hover:text-white hover:bg-gray-400 px-4"><i class="fas fa-sign-out-alt"></i> ログアウト</button>
    </form>
</div>

{{-- 店舗変更ダイアログ --}}
{{-- 処理ができたらちゃんと作る --}}
<div id="change-store-dialog">
    <p>店舗変更</p>
</div>

{{-- ログアウト確認ダイアログ --}}
<div id="logout-confirm-dialog">
    <div class="pt-2 pb-4">
        <p>本当にログアウトしてもよろしいですか？</p>
    </div>
</div>
