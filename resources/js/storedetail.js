// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js');  // ダイアログ

$(function() {
    // 未ログインユーザーが「口コミを投稿する」ボタンクリック時に表示するダイアログ
    $('#guest-add-post-dialog, #user-add-post-dialog, #user-finish-post-dialog').dialog({
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

    // 口コミ投稿画面から口コミを投稿した時に表示するダイアログ
    $('#sm-user-finish-post-dialog').dialog({
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

    // 未ログインユーザーが「口コミを投稿する」ボタンクリック時
    $('#sm-guest-add-post-button, #guest-add-post-button').on('click', function() {
        $('#guest-add-post-dialog').dialog('option', 'title', '口コミ投稿について');
        $('#guest-add-post-dialog').dialog('open');
    });

    // 画面幅md以上で「口コミを投稿する」ボタンクリック時
    $('#user-add-post-button').on('click', function() {
        // ログイン済みユーザーの場合
        $('#user-add-post-dialog').dialog('option', 'title', '口コミ投稿');
        $('#user-add-post-dialog').dialog('open');
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
        })
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
