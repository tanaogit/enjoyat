{{-- 汎用的なボタン(リンク付き) --}}
<a {{ $attributes->merge(['href' => $url, 'class' => 'px-8 py-4 border-gray-700 hover:text-gray-100 hover:bg-gray-600 font-bold border-2 rounded-lg']) }}>{{ $content }}</a>
