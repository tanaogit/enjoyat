{{-- 未ログインユーザーに対してログイン及び新規登録への導線を表示するダイアログ --}}
@props(['dialogId' => ''])

<div id="{{ $dialogId }}" class="hidden">
    <div class="pt-4 md:p-8 lg:mx-12">
        <p>本機能を利用するためにはログインが必要です。</p>
        <ul class="mx-auto text-center mt-8 w-4/5">
            <li>
                <a href="{{ route('user.login') }}" target="_blank" rel="noopener noreferrer" class="block font-bold bg-pink-400 rounded-lg hover:bg-pink-500 py-4">
                    ログイン画面へ
                </a>
            </li>
            <li class="mt-4">
                <a href="{{ route('user.register') }}" target="_blank" rel="noopener noreferrer" class="block font-bold border-gray-700 hover:text-gray-100 hover:bg-gray-600 border-2 rounded-lg py-4">
                    新規登録画面へ
                </a>
            </li>
        </ul>
    </div>
</div>
