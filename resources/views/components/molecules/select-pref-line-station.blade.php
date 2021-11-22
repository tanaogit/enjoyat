{{-- 都道府県から駅名までを取得するAPI --}}
<ul class="lg:flex justify-around">
    <li class="mb-4">
        <label>
            <span class="block lg:inline">都道府県：</span>
            <select name="pref" id="simple-search-panel_pref" class="w-full lg:w-auto">
                <option value="">都道府県を選択してください</option>
            </select>
        </label>
    </li>
    <li class="mb-4">
        <label>
            <span class="block lg:inline">路線：</span>
            <select name="line" id="simple-search-panel_line" class="w-full lg:w-auto">
                <option value="">路線を選択してください</option>
            </select>
        </label>
    </li>
    <li class="mb-4">
        <label>
            <span class="block lg:inline">駅名：</span>
            <select name="station" id="simple-search-panel_station" class="w-full lg:w-auto">
                <option value="">駅を選択してください</option>
            </select>
        </label>
    </li>
</ul>
