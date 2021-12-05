<ul style="line-height: 4rem" class="flex">
    <li class="md:mr-1 lg:mr-2 cursor-pointer font-bold hover:bg-gray-300">
        @if (Route::has('user.login'))
            @auth('users')
                <a href="{{ route('user.index') }}" class="block p-4" style="line-height: 4rem">マイページへ</a>
            @else
                <a href="{{ route('user.login') }}" class="block p-4" style="line-height: 4rem">無料会員登録</a>
            @endauth
        @endif
    </li>
    <li class="cursor-pointer font-bold hover:bg-gray-300">
        @if (Route::has('owner.login'))
            @auth('owners')
                <a href="{{ route('owner.index') }}" class="block p-4" style="line-height: 4rem">店舗管理画面へ</a>
            @else
                <a href="{{ route('owner.login') }}" class="block p-4" style="line-height: 4rem">お店をお持ちの方</a>
            @endauth
        @endif
    </li>
</ul>
