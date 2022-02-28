$(function() {
    // 写真投稿用の領域がクリックされた時の処理
    $('.storeimage-box').on('click', function() {
        $(this).next('.storeimage-input').trigger('click');
    });

    // 写真プレビュー処理
    // FileReaderオブジェクトを作成
    const fileReader      = new FileReader();
    const storeimageInput = $('.storeimage-input');
    storeimageInput.on('change', function() {
        // 最初にエラーメッセージがある場合に全て消す
        if (!$('#storeimage1_error').hasClass('hidden')) {
            $('#storeimage1_error').addClass('hidden');
        }
        if (!$('#storeimage2_error').hasClass('hidden')) {
            $('#storeimage2_error').addClass('hidden');
        }
        if (!$('#storeimage3_error').hasClass('hidden')) {
            $('#storeimage3_error').addClass('hidden');
        }

        // 1回で選択できる画像は1枚まで
        const file = $(this)[0].files[0];

        // 写真のサイズが1MBを超える場合処理を止める
        if (file.size > 1024 * 1024) {
            // エラーメッセージの表示
            const errorTarget = $(this).parent().nextAll('[id$="_error"]');
            errorTarget.text('※写真は1MB以下に設定してください。').css('margin', '0 auto').removeClass('hidden');
            $(this).val('');
            return false;
        }

        // 写真を表示する領域
        const storeimageBox = $(this).prev('.storeimage-box');

        fileReader.readAsDataURL(file);
        fileReader.onload = function(e) {
            const imageUrl = e.target.result;
            storeimageBox.children().remove();
            storeimageBox.addClass('overflow-hidden');
            storeimageBox.append('<img src="' + imageUrl + '"style="width: 200px; height: 200px; object-fit: cover;">');
        }

        // 取消ボタンの状態切り替え
        $(this).parent().next().children('.storeimage-cancel').prop('disabled', false).removeClass('text-gray-400 cursor-default');
    });
    // 写真プレビュー表示における取消ボタンがクリックされた時
    $('.storeimage-cancel').on('click', function() {
        // アップロードされていた写真を削除
        const storeimageBox = $(this).parent().prev().children('.storeimage-box');
        storeimageBox.children().remove();
        storeimageBox.append('<p class="text-4xl" style="margin-top: 70px;"><i class="fas fa-plus"></i></p><p style="margin-bottom: 70px;">写真(1MB以下)を<br>アップロード</p>');
        const storeimageInput = $(this).parent().prev().children('.storeimage-input');
        storeimageInput.val('');
        // 取消ボタンの状態切り替え
        $(this).prop('disabled', true).addClass('text-gray-400 cursor-default');
    });
});
