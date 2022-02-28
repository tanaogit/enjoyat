{{-- 写真投稿用フォーム --}}
@props(['action' => '', 'formId' => '', 'buttonId' => '', 'storeId' => '','errors' => ''])

<form method="post" enctype="multipart/form-data" action="{{ $action }}" id="{{ $formId }}">
    @csrf

    @error('store_id')
        <p class="text-red-500 text-sm font-semibold mb-2">※{{ $message }}</p>
    @enderror
    <p id="store_id_error" class="text-red-500 text-sm font-semibold mb-2 hidden"></p>

    <div class="md:grid md:grid-cols-3 gap-4">
        {{-- 写真1 --}}
        <div>
            <label>
                カテゴリ:
                <select name="category1" class="@error('category1') border border-red-500 @enderror">
                    <option value="foods" @if(old('category1') === 'foods') selected @endif>料理</option>
                    <option value="drinks" @if(old('category1') === 'drinks') selected @endif>ドリンク</option>
                    <option value="others" @if(old('category1') === 'others') selected @endif>その他</option>
                </select>
            </label>
            @error('category1')
                <p class="text-red-500 text-sm font-semibold mt-2">※{{ $message }}</p>
            @enderror
            <p id="category1_error" class="text-red-500 text-sm font-semibold mt-2 hidden" style="width: 200px;"></p>
            <div class="mt-4">
                <div class="storeimage-box mx-auto cursor-pointer text-center border border-gray-500 border-dashed active:border-blue-400" style="width: 200px; height: 200px;">
                    <p class="text-4xl" style="margin-top: 70px;"><i class="fas fa-plus"></i></p>
                    <p style="margin-bottom: 70px;">写真(1MB以下)を<br>アップロード</p>
                </div>
                <input type="file" name="storeimage1" accept="image/png,image/jpeg,image/jpg" class="storeimage-input hidden">
            </div>
            <div class="text-center my-2">
                <button type="button" class="storeimage-cancel text-gray-400 cursor-default" disabled><i class="fas fa-times mr-1"></i>取消</button>
            </div>
            @error('storeimage1')
                <p class="text-red-500 text-sm font-semibold mt-2">※{{ $message }}</p>
            @enderror
            <p id="storeimage1_error" class="text-red-500 text-sm font-semibold mt-2 hidden" style="width: 200px;"></p>
        </div>
        {{-- 写真2 --}}
        <div class="mt-10 md:mt-0">
            <label>
                カテゴリ:
                <select name="category2" class="@error('category2') border border-red-500 @enderror">
                    <option value="foods" @if(old('category2') === 'foods') selected @endif>料理</option>
                    <option value="drinks" @if(old('category2') === 'drinks') selected @endif>ドリンク</option>
                    <option value="others" @if(old('category2') === 'others') selected @endif>その他</option>
                </select>
            </label>
            @error('category2')
                <p class="text-red-500 text-sm font-semibold mt-2">※{{ $message }}</p>
            @enderror
            <p id="category2_error" class="text-red-500 text-sm font-semibold mt-2 hidden" style="width: 200px;"></p>
            <div class="mt-4">
                <div class="storeimage-box mx-auto cursor-pointer text-center border border-gray-500 border-dashed active:border-blue-400" style="width: 200px; height: 200px;">
                    <p class="text-4xl" style="margin-top: 70px;"><i class="fas fa-plus"></i></p>
                    <p style="margin-bottom: 70px;">写真(1MB以下)を<br>アップロード</p>
                </div>
                <input type="file" name="storeimage2" accept="image/png,image/jpeg,image/jpg" class="storeimage-input hidden">
            </div>
            <div class="text-center my-2">
                <button type="button" class="storeimage-cancel text-gray-400 cursor-default" disabled><i class="fas fa-times mr-1"></i>取消</button>
            </div>
            @error('storeimage2')
                <p class="text-red-500 text-sm font-semibold mt-2">※{{ $message }}</p>
            @enderror
            <p id="storeimage2_error" class="text-red-500 text-sm font-semibold mt-2 hidden" style="width: 200px;"></p>
        </div>
        {{-- 写真3 --}}
        <div class="mt-10 md:mt-0">
            <label>
                カテゴリ:
                <select name="category3" class="@error('category3') border border-red-500 @enderror">
                    <option value="foods" @if(old('category3') === 'foods') selected @endif>料理</option>
                    <option value="drinks" @if(old('category3') === 'drinks') selected @endif>ドリンク</option>
                    <option value="others" @if(old('category3') === 'others') selected @endif>その他</option>
                </select>
            </label>
            @error('category3')
                <p class="text-red-500 text-sm font-semibold mt-2">※{{ $message }}</p>
            @enderror
            <p id="category3_error" class="text-red-500 text-sm font-semibold mt-2 hidden" style="width: 200px;"></p>
            <div class="mt-4">
                <div class="storeimage-box mx-auto cursor-pointer text-center border border-gray-500 border-dashed active:border-blue-400" style="width: 200px; height: 200px;">
                    <p class="text-4xl" style="margin-top: 70px;"><i class="fas fa-plus"></i></p>
                    <p style="margin-bottom: 70px;">写真(1MB以下)を<br>アップロード</p>
                </div>
                <input type="file" name="storeimage3" accept="image/png,image/jpeg,image/jpg" class="storeimage-input hidden">
            </div>
            <div class="text-center my-2">
                <button type="button" class="storeimage-cancel text-gray-400 cursor-default" disabled><i class="fas fa-times mr-1"></i>取消</button>
            </div>
            @error('storeimage3')
                <p class="text-red-500 text-sm font-semibold mt-2">※{{ $message }}</p>
            @enderror
            <p id="storeimage3_error" class="text-red-500 text-sm font-semibold mt-2 hidden" style="width: 200px;"></p>
        </div>
    </div>

    <x-atoms.buttons.pink-button content="投稿する" buttonId="{{ $buttonId }}" class="mt-4 px-6 py-4 w-full" />

    <input id="store_id" type="hidden" name="store_id" value="{{ $storeId }}">
</form>
