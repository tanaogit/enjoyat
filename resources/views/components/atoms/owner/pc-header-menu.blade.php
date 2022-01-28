<div class="flex">
    <a href="" class="block lg:mr-2 cursor-pointer font-bold hover:bg-gray-300 pt-4 px-8" style="line-height: 4rem">設定</a>
    <button type="button" id="pc-owner-changeStore-button" class="p-4 cursor-pointer font-bold hover:bg-gray-300" style="line-height: 4rem">店舗変更</button>
    <form method="POST" action="{{ route('owner.logout') }}" class="owner-logout-form">
        @csrf
        <button id="pc-owner-logout-button" class="p-4 cursor-pointer font-bold hover:bg-gray-300" style="line-height: 4rem">ログアウト</button>
    </form>
</div>
