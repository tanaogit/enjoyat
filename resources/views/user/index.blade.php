<x-pages.user.template>
    <x-slot name="title">ユーザーのダッシュボード - Enjoyat</x-slot>

    {{-- ログアウト確認ダイアログ --}}
    <div id="logout-confirm-dialog">
        <div class="pt-2 pb-4">
            <p>本当にログアウトしてもよろしいですか？</p>
        </div>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/user/index.js') }}"></script>
    </x-slot>
</x-pages.user.template>
