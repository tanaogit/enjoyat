{{-- ユーザーがログイン中の場合に表示するbookmarkボタン --}}
{{-- 画面幅がmd未満の時 --}}
<x-atoms.buttons.sm-bookmark-register-button buttonId="sm-user-bookmark-button">
    @if (empty($category) || $category[0] === 'register') {{-- 未登録またはcategoryがregisterの時 --}}
        <i class="far fa-heart text-4xl"></i>
    @elseif ($category[0] === 'bookmark') {{-- categoryがbookmarkのとき --}}
        <i class="fas fa-heart text-4xl text-pink-400"></i>
    @endif
</x-atoms.buttons.sm-bookmark-register-button>

{{-- 画面幅がmd以上の時 --}}
<x-atoms.buttons.md-bookmark-register-button
    buttonId="md-user-bookmark-button"
    class="p-4 {{ (empty($category) || $category[0] === 'register') ? 'border-gray-400' : 'text-pink-400 border-pink-400' }}">
    @if (empty($category) || $category[0] === 'register') {{-- 未登録またはcategoryがregisterの時 --}}
        <span>
            <i class="far fa-heart text-xl"></i> お気に入り
        </span>
    @elseif ($category[0] === 'bookmark') {{-- categoryがbookmarkのとき --}}
        <span>
            <i class="fas fa-heart text-xl"></i> お気に入り
        </span>
    @endif
</x-atoms.buttons.md-bookmark-register-button>
