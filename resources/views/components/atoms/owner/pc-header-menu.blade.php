<form method="POST" action="{{ route('owner.logout') }}" class="owner-logout-form">
    @csrf
    <button id="pc-owner-logout-button" class="p-4 cursor-pointer font-bold hover:bg-gray-300" style="line-height: 4rem">
        ログアウト
    </button>
</form>
