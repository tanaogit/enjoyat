{{-- レイアウトなどざっくりと作ってるから今後要素が増えた時に再度修正が必要だと思う --}}
<footer class="bg-gray-800 text-center py-5">
    <x-atoms.service-logo class="h-10 md:h-12 w-1/2 md:w-10/12 mx-auto" />
    <ul class="text-gray-100 flex justify-around m-4">
        {{-- ひとまずcontactのみ(今後増やす方向) --}}
        <li><a href="{{ route('support.contact') }}" class="hover:underline">Contact</a></li>
    </ul>
    <small class="text-gray-100">© 2022 Enjoyat</small>
</footer>
