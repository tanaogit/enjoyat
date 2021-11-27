{{-- 主に検索用のボタンとして使う --}}
@props(['content' => '検索'])
<button {{ $attributes->merge(['class' => 'font-bold bg-pink-400 px-8 py-4 rounded-lg hover:bg-pink-500']) }}>{{ $content }}</button>
