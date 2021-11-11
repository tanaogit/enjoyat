<form action="{{ route('search.index') }}" method="get">
    @csrf
    {{-- 都道府県から駅名までの選択欄 --}}
    <x-molecules.select-pref-line-station />

    <div class="text-center mt-8 md:mt-12">
        <x-atoms.buttons.search-button content="この条件でお店を探す" class="w-64" />
    </div>
</form>
