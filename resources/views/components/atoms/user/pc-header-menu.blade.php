<form method="POST" action="{{ route('user.logout') }}" class="user-logout-form">
    @csrf
    <button id="pc-user-logout-button" class="p-4 cursor-pointer font-bold hover:bg-gray-300" style="line-height: 4rem">
        ログアウト
    </button>
</form>
