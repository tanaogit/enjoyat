{{-- 画面幅がmd以上の時のbookmarkおよびregister用のボタン --}}
@props(['buttonId' => ''])
<button id="{{ $buttonId }}" {{ $attributes->merge(['class' => 'hidden md:block border rounded-md']) }}>
    {{ $slot }}
</button>
