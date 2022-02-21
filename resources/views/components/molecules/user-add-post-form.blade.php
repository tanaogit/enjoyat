{{-- 口コミ投稿用フォーム --}}
@props(['action' => '', 'formId' => '', 'buttonId' => '', 'userId' => '', 'storeId' => '', 'errors' => ''])

<form method="post" action="{{ $action }}" id="{{ $formId }}">
    @csrf

    @error('user_id')
        <p class="text-red-500 text-sm font-semibold mb-4">※{{ $message }}</p>
    @enderror
    <p id="user_id_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>
    @error('store_id')
        <p class="text-red-500 text-sm font-semibold mb-4">※{{ $message }}</p>
    @enderror
    <p id="store_id_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>

    <label>
        星評価
        <div class="grid grid-cols-3 gap-y-4">
            <div>
                評価項目1
                <input name="evaluation1" type="number" min="0" max="5" placeholder="-" value="{{ old('evaluation1') }}" class="ml-1 pr-1 @error('evaluation1') border-red-500 @enderror" required>
            </div>
            <div>
                評価項目2
                <input name="evaluation2" type="number" min="0" max="5" placeholder="-" value="{{ old('evaluation2') }}" class="ml-1 pr-1 @error('evaluation2') border-red-500 @enderror" required>
            </div>
            <div>
                評価項目3
                <input name="evaluation3" type="number" min="0" max="5" placeholder="-" value="{{ old('evaluation3') }}" class="ml-1 pr-1 @error('evaluation3') border-red-500 @enderror" required>
            </div>
            <div>
                評価項目4
                <input name="evaluation4" type="number" min="0" max="5" placeholder="-" value="{{ old('evaluation4') }}" class="ml-1 pr-1 @error('evaluation4') border-red-500 @enderror" required>
            </div>
            <div>
                評価項目5
                <input name="evaluation5" type="number" min="0" max="5" placeholder="-" value="{{ old('evaluation5') }}" class="ml-1 pr-1 @error('evaluation5') border-red-500 @enderror" required>
            </div>
        </div>
    </label>
    <div class="mt-2">
        @error('evaluation1')
            <p class="text-red-500 text-sm font-semibold">※{{ $message }}</p>
        @enderror
        <p id="evaluation1_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>
        @error('evaluation2')
            <p class="text-red-500 text-sm font-semibold">※{{ $message }}</p>
        @enderror
        <p id="evaluation2_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>
        @error('evaluation3')
            <p class="text-red-500 text-sm font-semibold">※{{ $message }}</p>
        @enderror
        <p id="evaluation3_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>
        @error('evaluation4')
            <p class="text-red-500 text-sm font-semibold">※{{ $message }}</p>
        @enderror
        <p id="evaluation4_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>
        @error('evaluation5')
            <p class="text-red-500 text-sm font-semibold">※{{ $message }}</p>
        @enderror
        <p id="evaluation5_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>
    </div>
    <div class="mt-4">
        <label>
            <p>タイトル</p>
            <input type="text" name="title" placeholder="非常に良いお店でした。"  value="{{ old('title') }}" maxlength="100" class="w-full @error('title') border-red-500 @enderror" required>
        </label>
        @error('title')
        <p class="text-red-500 text-sm font-semibold">※{{ $message }}</p>
        @enderror
        <p id="title_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>
    </div>
    <div class="mt-4">
        <label>
            <p>本文</p>
            <textarea name="message" rows="4" placeholder="お店の雰囲気も良く、料理もとても美味しかったです。" class="w-full" maxlength="10000" required>{{ old('message') }}</textarea>
        </label>
        @error('message')
        <p class="text-red-500 text-sm font-semibold">※{{ $message }}</p>
        @enderror
        <p id="message_error" class="text-red-500 text-sm font-semibold mb-4 hidden"></p>
    </div>
    <x-atoms.buttons.pink-button content="投稿する" buttonId="{{ $buttonId }}" class="mt-4 px-6 py-4 w-full font-bold" />

    <input id="user_id" type="hidden" name="user_id" value="{{ $userId }}">
    <input id="store_id" type="hidden" name="store_id" value="{{ $storeId }}">
</form>
