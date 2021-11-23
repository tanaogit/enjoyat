<form id="search-form" action="{{ route('search.simplesearch') }}" method="get">
    @csrf
    {{-- 都道府県から駅名までの選択欄 --}}
    <label class="border-l-4 border-pink-400 pl-2">
        アクセス
        <div class="h-4"></div> {{-- スペース用 --}}
        <x-molecules.select-pref-line-station />
    </label>

    {{-- 詳細検索欄 --}}
    <div id="detail-search-options" class="hidden">
        <label id="detail-search-options_freeword" class="border-l-4 border-pink-400 pl-2">
            フリーワード
            <input type="text" name="freeword" placeholder="Enjoyat食堂" class="mt-4 w-full">
        </label>
        <div class="h-4"></div> {{-- スペース用 --}}
        <label id="detail-search-options_freeword" class="border-l-4 border-pink-400 pl-2">
            営業日
            <select name="businessdays[]" class="w-full mt-4" multiple>
                <option value="sunday">日曜日</option>
                <option value="monday">月曜日</option>
                <option value="tuesday">火曜日</option>
                <option value="wednesday">水曜日</option>
                <option value="thursday">木曜日</option>
                <option value="friday">金曜日</option>
                <option value="saturday">土曜日</option>
            </select>
        </label>
        <div class="h-4"></div> {{-- スペース用 --}}
        <span id="detail-search-options_evaluation" class="border-l-4 border-pink-400 pl-2">
            クチコミの評価
            <p class="flex justify-between md:block mt-4">
                <label>
                    <input type="radio" name="evaluation" value="4" class="mr-2">4以上
                </label>
                <label class="md:ml-16">
                    <input type="radio" name="evaluation" value="3" class="mr-2">3以上
                </label>
                <label class="md:ml-16">
                    <input type="radio" name="evaluation" value="2" class="mr-2">2以上
                </label>
                <label class="md:ml-16">
                    <input type="radio" name="evaluation" value="1" class="mr-2">1以上
                </label>
            </p>
        </span>
        <div class="h-4"></div> {{-- スペース用 --}}
        <label id="detail-search-options_payments" class="border-l-4 border-pink-400 pl-2">
            支払い方法
            <select name="payments[]" class="w-full mt-4" multiple>
                @foreach ($payments as $payment)
                    <option value="{{ $payment->id }}">{{ $payment->method }}</option>
                @endforeach
            </select>
        </label>
        <div class="h-4"></div> {{-- スペース用 --}}
        <span id="detail-search-options_coupon" class="border-l-4 border-pink-400 pl-2">
            クーポン
            <p class="mt-4">
                <label>
                    <input type="radio" name="coupon" value="0" class="mr-2">無
                </label>
                <label class="ml-16">
                    <input type="radio" name="coupon" value="1" class="mr-2">有
                </label>
            </p>
        </span>
        <div class="h-4"></div> {{-- スペース用 --}}
        <label id="detail-search-options_genres" class="border-l-4 border-pink-400 pl-2">
            ジャンル
            <select name="genres[]" class="w-full mt-4" multiple>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div id="add-detail-options" class="text-center mt-4">
        <button type="button" id="add-detail-button" class="text-lg">
            <i class="fas fa-arrow-alt-circle-down"></i> 検索条件を追加する <i class="fas fa-arrow-alt-circle-down"></i>
        </button>
    </div>

    <div id="remove-detail-options" class="hidden text-center mt-4">
        <button type="button" id="remove-detail-button" class="text-lg">
            <i class="fas fa-arrow-circle-up"></i> 検索条件を絞る <i class="fas fa-arrow-circle-up"></i>
        </button>
    </div>

    <div class="text-center mt-8 md:mt-12">
        <x-atoms.buttons.search-button content="この条件でお店を探す" class="w-64" />
    </div>
</form>
