{{-- 未ログインユーザーの場合に表示するregisterボタン --}}
{{-- 画面幅がmd未満の時 --}}
<x-atoms.buttons.sm-bookmark-register-button buttonId="sm-guest-register-button" class="mx-4">
    <i class="far fa-square text-4xl"></i>
</x-atoms.buttons.sm-bookmark-register-button>
{{-- 画面幅がmd以上の時 --}}
<x-atoms.buttons.md-bookmark-register-button
    buttonId="md-guest-register-button"
    class="mx-4 py-4 px-6 border-gray-400">
    <i class="far fa-square text-xl"></i> 登録済み
</x-atoms.buttons.md-bookmark-register-button>
