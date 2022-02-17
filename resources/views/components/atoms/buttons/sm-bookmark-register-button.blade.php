{{-- 画面幅がmd未満の時のbookmarkおよびregister用のボタン --}}
@props(['buttonId' => ''])
<button id="{{ $buttonId }}" {{ $attributes->merge(['class' => 'md:hidden']) }}>
    {{ $slot }}
</button>
