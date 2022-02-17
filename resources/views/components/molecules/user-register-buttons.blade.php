{{-- ユーザーがログイン中の場合に表示するregisterボタン --}}
{{-- 画面幅がmd未満の時 --}}
<x-atoms.buttons.sm-bookmark-register-button buttonId="sm-user-register-button" class="mx-4">
    @if (empty($category) || $category[0] === 'bookmark')
        <i class="far fa-square text-4xl"></i>
    @else
        <i class="far fa-check-square text-4xl text-pink-400"></i>
    @endif
</x-atoms.buttons.sm-bookmark-register-button>

{{-- 画面幅がmd以上の時 --}}
<x-atoms.buttons.md-bookmark-register-button
    buttonId="md-user-register-button"
    class="mx-4 py-4 px-6 {{ (empty($category) || $category[0] === 'bookmark') ? 'border-gray-400' : 'text-pink-400 border-pink-400' }}">
    @if (empty($category) || $category[0] === 'bookmark')
        <span>
            <i class="far fa-square text-xl"></i> 登録済み
        </span>
    @else
        <span>
            <i class="far fa-check-square text-xl"></i> 登録済み
        </span>
    @endif
</x-atoms.buttons.md-bookmark-register-button>
