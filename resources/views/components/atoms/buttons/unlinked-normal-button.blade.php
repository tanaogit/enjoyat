{{-- 汎用的なボタン(リンクなし) --}}
@props(['buttonId' => ''])
<button id="{{ $buttonId }}" {{ $attributes->merge(['class' => 'font-bold rounded-lg border-2 border-gray-700 hover:text-gray-100 hover:bg-gray-600']) }}>
    {{ $slot }}
</button>
