// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js');  // ダイアログ

$(function() {
    // 各種ダイアログ
    $('#guest-add-storeimages-post-dialog, #user-add-post-dialog, #user-finish-post-dialog, #user-add-storeimages-dialog').dialog({
        autoOpen: false,
        width: 'auto',
        height: 'auto',
        modal: true,
        draggable: false,
        resizable: false,
        buttons: [
            {
                html: '<i class="fas fa-times"></i> 閉じる',
                click: function() {
                    $(this).dialog('close');
                },
            }
        ],
    });

    // 写真投稿ダイアログから投稿が成功した時に表示するダイアログ
    $('#user-finish-storeimages-dialog').dialog({
        autoOpen: false,
        width: 'auto',
        height: 'auto',
        modal: true,
        draggable: false,
        resizable: false,
        buttons: [
            {
                html: '<i class="fas fa-times"></i> 閉じる',
                click: function() {
                    $(this).dialog('close');
                    location.reload(); // 画面更新
                },
            }
        ],
    });

    // 写真投稿画面または口コミ投稿画面から投稿が成功した時に表示するダイアログ
    $('#sm-user-finish-storeimages-post-dialog').dialog({
        width: 'auto',
        height: 'auto',
        modal: true,
        draggable: false,
        resizable: false,
        buttons: [
            {
                html: '<i class="fas fa-times"></i> 閉じる',
                click: function() {
                    $(this).dialog('close');
                },
            }
        ],
    });

    // 「店舗の紹介」の文章の文字数を取得
    const textLength = $('#store-introduction').text().length;
    // 基準となる文字数
    let maxtextLength = 150;
    if (window.innerWidth > 1024) {
        // 画面幅がlg以上の時
        maxtextLength = 1000;
    } else if (window.innerWidth > 768) {
        // 画面幅がmd以上の時
        maxtextLength = 300;
    }
    // 基準となる文字数を超えたら三点リーダーで隠す
    if (textLength > maxtextLength) {
        $('#store-introduction').css({
            'display': '-webkit-box',
            '-webkit-box-orient': 'vertical',
            '-webkit-line-clamp': '4',
            'overflow': 'hidden',
        });
        $('#store-introduction-button').show();
    }

    // 写真投稿ダイアログから投稿した時の処理
    function changeRegisterStoreimagesDialog(type) {
        $('#user-add-storeimages-dialog').dialog('close');
        if (type === 'success') {
            // 投稿完了時
            $('#user-finish-storeimages-dialog-text').text('写真を投稿しました。');
            $('#user-finish-storeimages-dialog').dialog('open');
        } else {
            // 投稿失敗時
            $('#user-finish-storeimages-dialog-text').text('通信に失敗しました。');
            $('#user-finish-storeimages-dialog').dialog('open');
        }
        // 右上の閉じるボタンをクリックした時に画面更新する
        $('#user-finish-storeimages-dialog').prev('.ui-dialog-titlebar').children('.ui-button').on('click', function() {
            location.reload();
        });
    }

    // 口コミ投稿ダイアログから投稿した時の処理
    function changeRegisterPostDialog(type) {
        if (type === 'success') {
            // 投稿完了時
            $('#user-add-post-dialog').dialog('close');
            $('#add-post-button-area').children('#user-add-post-button').remove();
            $('#add-post-button-area').append('<div class="select-none px-8 py-4 font-bold rounded-lg border-2 border-gray-700 text-white bg-gray-600"><i class="far fa-comments mr-1"></i>口コミ投稿済</div>');
            $('#user-finish-post-dialog-text').text('口コミを投稿しました。');
            $('#user-finish-post-dialog').dialog('open');
        } else {
            // 投稿失敗時
            $('#user-add-post-dialog').dialog('close');
            $('#register-post-button').prop('disabled', false).removeClass('bg-gray-200').addClass('bg-pink-400 hover:bg-pink-500').text('投稿する');
            $('#user-finish-post-dialog-text').text('通信に失敗しました。');
            $('#user-finish-post-dialog').dialog('open');
        }
    }

    // 未ログインユーザーが「写真を投稿する」ボタンクリック時
    $('#sm-guest-add-storeimages-button, #guest-add-storeimages-button').on('click', function() {
        $('#guest-add-storeimages-post-dialog').dialog('option', 'title', '写真投稿について');
        $('#guest-add-storeimages-post-dialog').dialog('open');
    });

    // 未ログインユーザーが「口コミを投稿する」ボタンクリック時
    $('#sm-guest-add-post-button, #guest-add-post-button').on('click', function() {
        $('#guest-add-storeimages-post-dialog').dialog('option', 'title', '口コミ投稿について');
        $('#guest-add-storeimages-post-dialog').dialog('open');
    });

    // ログイン済みユーザーが画面幅md以上で「写真を投稿する」ボタンクリック時
    $('#user-add-storeimages-button').on('click', function() {
        $('#user-add-storeimages-dialog').dialog('option', 'title', '写真投稿');
        $('#user-add-storeimages-dialog').dialog('open');
    });

    // ログイン済みユーザーが画面幅md以上で「口コミを投稿する」ボタンクリック時
    $('#user-add-post-button').on('click', function() {
        $('#user-add-post-dialog').dialog('option', 'title', '口コミ投稿');
        $('#user-add-post-dialog').dialog('open');
    });

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
            errorTarget.text('※写真は1MB以下に設定してください。').removeClass('hidden');
            $(this).val('');
            return false;
        }

        // 写真を表示する領域
        const storeimageBox = $(this).prev('.storeimage-box');

        fileReader.readAsDataURL(file);
        fileReader.onload = function(e) {
            const imageUrl = e.target.result;
            // 写真をプレビュー表示
            storeimageBox.children().remove();
            storeimageBox.addClass('overflow-hidden');
            storeimageBox.append('<img src="' + imageUrl + '"style="width: 200px; height: 200px; object-fit: cover;">');
        }

        // 取消ボタンの状態切り替え
        $(this).parent().next().children('.storeimage-cancel').prop('disabled', false).removeClass('text-gray-400 cursor-default');
    });

    // 写真プレビュー表示における取消ボタンがクリックされた時
    $('.storeimage-cancel').on('click', function() {
        // 写真のプレビューを元に戻す
        const storeimageBox = $(this).parent().prev().children('.storeimage-box');
        storeimageBox.children().remove();
        storeimageBox.append('<p class="text-4xl" style="margin-top: 70px;"><i class="fas fa-plus"></i></p><p style="margin-bottom: 70px;">写真(1MB以下)を<br>アップロード</p>');
        // アップロードされていた写真を削除
        const storeimageInput = $(this).parent().prev().children('.storeimage-input');
        storeimageInput.val('');
        // 取消ボタンの状態切り替え
        $(this).prop('disabled', true).addClass('text-gray-400 cursor-default');
    });

    // 写真投稿ダイアログから投稿された時
    $('#register-storeimages-form').submit(function(e) {
        e.preventDefault();
        const url = $(this).attr('action');
        const formData = new FormData($(this)[0]);

        $.ajax({
            type: 'post',
            url: url,
            dateType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#register-storeimages-button').prop('disabled', true).removeClass('bg-pink-400 hover:bg-pink-500').addClass('bg-gray-200').html('<i class="fas fa-spinner animate-spin"></i>');
            },
        })
        .done(function(res) {
            changeRegisterStoreimagesDialog(res.type);
        })
        .fail(function(error) {
            // 「投稿する」ボタンを元に戻す
            $('#register-storeimages-button').prop('disabled', false).removeClass('bg-gray-200').addClass('bg-pink-400 hover:bg-pink-500').text('投稿する');
            if (error.responseJSON.errors !== undefined) {
                Object.keys(error.responseJSON.errors).forEach(function(key) {
                    // エラーメッセージの表示
                    $('#' + key + '_error').removeClass('hidden').text('※' + error.responseJSON.errors[key][0]);
                    // 「カテゴリ」部分でバリデーションに引っかかった時
                    if (['category1', 'category2', 'category3'].includes(key)) {
                        $('[name="' + key + '"]').addClass('border border-red-500');
                    }
                });
            }
        });
    });

    // 口コミ投稿ダイアログから投稿された時
    $('#register-post-form').submit(function(e) {
        e.preventDefault();
        const url = $(this).attr('action');

        $.ajax({
            type: 'post',
            url: url,
            dateType: 'json',
            data: {
                '_token':      $('input[name="_token"]').val(),
                'evaluation1': $('input[name="evaluation1"]').val(),
                'evaluation2': $('input[name="evaluation2"]').val(),
                'evaluation3': $('input[name="evaluation3"]').val(),
                'evaluation4': $('input[name="evaluation4"]').val(),
                'evaluation5': $('input[name="evaluation5"]').val(),
                'evaluation5': $('input[name="evaluation5"]').val(),
                'title':       $('input[name="title"]').val(),
                'message':     $('textarea[name="message"]').val(),
                'user_id':     $('#user_id').val(),
                'store_id':    $('#store_id').val(),
            },
            beforeSend: function() {
                $('#register-post-button').prop('disabled', true).removeClass('bg-pink-400 hover:bg-pink-500').addClass('bg-gray-200').html('<i class="fas fa-spinner animate-spin"></i>');
            },
        })
        .done(function(res) {
            changeRegisterPostDialog(res.type);
        })
        .fail(function(error) {
            $('#register-post-button').prop('disabled', false).removeClass('bg-gray-200').addClass('bg-pink-400 hover:bg-pink-500').text('投稿する');
            if (error.responseJSON.errors !== undefined) {
                Object.keys(error.responseJSON.errors).forEach(key => {
                    $('[name="' + key + '"]').addClass('border-red-500');
                    $('#' + key + '_error').removeClass('hidden').text('※' + error.responseJSON.errors[key]);
                });
            }
        });
    });

    // 「もっと見る」ボタンクリック時
    $('#store-introduction-button').on('click', function() {
        // テキストが省略されている時(念のために入れている)
        if ($('#store-introduction').attr('style')) {
            $(this).remove(); // ボタンを削除
            $('#store-introduction').removeAttr('style'); // 全文表示
        }
    });
});
