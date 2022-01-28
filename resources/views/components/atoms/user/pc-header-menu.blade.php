<div class="flex">
    <a href="" class="block lg:mr-2 cursor-pointer font-bold hover:bg-gray-300 pt-4 px-8" style="line-height: 4rem">設定</a>
    <form method="POST" action="{{ route('user.logout') }}" class="user-logout-form">
        @csrf
        <button id="pc-user-logout-button" class="lg:mr-2 cursor-pointer font-bold hover:bg-gray-300 p-4" style="line-height: 4rem">ログアウト</button>
    </form>
</div>
