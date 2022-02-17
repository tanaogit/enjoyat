{{-- 未ログインユーザーの場合に表示するbookmarkボタン --}}
{{-- 画面幅がmd未満の時 --}}
<x-atoms.buttons.sm-bookmark-register-button buttonId="sm-guest-bookmark-button">
    <i class="far fa-heart text-4xl"></i>
</x-atoms.buttons.sm-bookmark-register-button>
{{-- 画面幅がmd以上の時 --}}
<x-atoms.buttons.md-bookmark-register-button buttonId="md-guest-bookmark-button" class="p-4 border-gray-400">
    <i class="far fa-heart text-xl"></i> お気に入り
</x-atoms.buttons.md-bookmark-register-button>
