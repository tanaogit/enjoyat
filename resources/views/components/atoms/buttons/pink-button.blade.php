{{-- 主に重要度が高く目立たせたい時に使う --}}
{{-- 汎用的に使うためmarginやpaddingは都度設定 --}}
@props(['buttonId' => '', 'content' => 'ボタン'])
<button id="{{ $buttonId }}" {{ $attributes->merge(['class' => 'font-bold bg-pink-400 rounded-lg hover:bg-pink-500']) }}>
    {{ $content }}
</button>
