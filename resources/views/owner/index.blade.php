<x-pages.owner.template>
    <x-slot name="title">オーナーのダッシュボード - Enjoyat</x-slot>

    {{-- ログアウト確認ダイアログ --}}
    <div id="logout-confirm-dialog">
        <div class="pt-2 pb-4">
            <p>本当にログアウトしてもよろしいですか？</p>
        </div>
    </div>

    <x-slot name="jsFile">
        <script src="{{ mix('js/owner/index.js') }}"></script>
    </x-slot>
</x-pages.owner.template>
