{{-- ユーザーのログイン後のPC画面におけるサイドバー --}}
@props(['style' => ''])
<div {{ $attributes->merge(['class' => 'hidden lg:block bg-gray-900 select-none']) }} style="{{ $style }}">
    <x-atoms.service-logo divClass="my-8" class="h-12 mx-auto" />
    <nav>
        <ul class="text-gray-400">
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> ホーム</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あい</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいう</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえ</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえお</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえおか</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえおかき</a></li>
            <li class="hover:text-white hover:bg-gray-800 leading-10"><a href="" class="block px-8"><i class="fas fa-home"></i> あいうえおかきく</a></li>
        </ul>
    </nav>
</div>
