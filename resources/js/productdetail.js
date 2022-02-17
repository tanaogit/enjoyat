// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js');  // ダイアログ

$(function() {
    // ログイン済みユーザーまたは未ログインユーザーがbookmark用ボタンまたはregister用ボタンをクリック時に表示するダイアログ
    $('#guest-bookmark-register-dialog, #user-bookmark-register-dialog').dialog({
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

    // 「サブスクの紹介」の文章の文字数を取得
    const textLength = $('#product-description').text().length;
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
        $('#product-description').css({
            'display': '-webkit-box',
            '-webkit-box-orient': 'vertical',
            '-webkit-line-clamp': '4',
            'overflow': 'hidden',
        });
        $('#product-description-button').show();
    }

    // ログイン済みユーザーのbookmark用ボタンまたはregister用ボタンクリック時のダイアログの設定処理
    function openBookmarkRegisterDialog(category, type) {
        let title;
        let text;
        if (category === 'bookmark') {
            title = 'お気に入り';
            if (type === 'insert') {
                text = 'お気に入りに追加しました。';
            } else if (type === 'delete') {
                text = 'お気に入りから削除しました。';
            } else {
                text = '通信に失敗しました。';
            }
        } else {
            title = '登録済み';
            if (type === 'insert' || type === 'update') {
                text = '登録済みに追加しました。';
            } else if (type === 'delete') {
                text = '登録済みから削除しました。';
            } else {
                text = '通信に失敗しました。';
            }
        }
        $('#user-bookmark-register-dialog').dialog('option', 'title', title);
        $('#user-bookmark-register-dialog-text').text(text);
        $('#user-bookmark-register-dialog').dialog('open');
    }

    // ログイン済みユーザーのbookmark用ボタンクリック時の処理
    function toggleBookmarkButton(type) {
        if (type === 'insert') {
            $('#sm-user-bookmark-button').children('i').removeClass('far').addClass('fas text-pink-400');
            $('#md-user-bookmark-button').removeClass('border-gray-400').addClass('text-pink-400 border-pink-400');
            $('#md-user-bookmark-button').children('span').remove();
            $('#md-user-bookmark-button').append('<span><i class="fas fa-heart text-xl"></i> お気に入り</span>');
        } else if (type === 'delete') {
            $('#sm-user-bookmark-button').children('i').removeClass('fas text-pink-400').addClass('far');
            $('#md-user-bookmark-button').removeClass('text-pink-400 border-pink-400').addClass('border-gray-400');
            $('#md-user-bookmark-button').children('span').remove();
            $('#md-user-bookmark-button').append('<span><i class="far fa-heart text-xl"></i> お気に入り</span>');
        }
    }

    // ログイン済みユーザーのregister用ボタンクリック時の処理
    function toggleRegisterButton(type) {
        if (type === 'insert' || type === 'update') {
            // bookmark用のボタンを非表示
            toggleBookmarkButton('delete');
            $('#bookmark-list').hide();
            // register用のボタンを変更
            $('#sm-user-register-button').children('i').removeClass('fa-square').addClass('fa-check-square text-pink-400');
            $('#md-user-register-button').removeClass('border-gray-400').addClass('text-pink-400 border-pink-400');
            $('#md-user-register-button').children('span').remove();
            $('#md-user-register-button').append('<span><i class="far fa-check-square text-xl"></i> 登録済み</span>');
        } else if (type === 'delete') {
            // bookmark用のボタンを表示
            $('#bookmark-list').show();
            // register用のボタンを変更
            $('#sm-user-register-button').children('i').removeClass('fa-check-square text-pink-400').addClass('fa-square');
            $('#md-user-register-button').removeClass('text-pink-400 border-pink-400').addClass('border-gray-400');
            $('#md-user-register-button').children('span').remove();
            $('#md-user-register-button').append('<span><i class="far fa-square text-xl"></i> 登録済み</span>');
        }
    }

    // 未ログインユーザーがbookmark用ボタンをクリック時
    $('#sm-guest-bookmark-button, #md-guest-bookmark-button').on('click', function() {
        $('#guest-bookmark-register-dialog').dialog('option', 'title', 'お気に入りボタンについて');
        $('#guest-bookmark-register-dialog').dialog('open');
    });

    // 未ログインユーザーがregister用ボタンをクリック時
    $('#sm-guest-register-button, #md-guest-register-button').on('click', function() {
        $('#guest-bookmark-register-dialog').dialog('option', 'title', '登録済みボタンについて');
        $('#guest-bookmark-register-dialog').dialog('open');
    });

    // ログイン済みユーザーがbookmark用ボタンをクリック時
    $('#sm-user-bookmark-button, #md-user-bookmark-button').on('click', function() {
        const url       = $('[name="bookmark-url"]').val();
        const userId    = $('[name="user_id"]').val();
        const productId = $('[name="product_id"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: 'post',
            url: url,
            dataType: 'json',
            data: {
                'userId': userId,
                'productId': productId,
            },
            beforeSend: function() {
                $(this).attr('disabled');
            },
        })
        .done(function(res) {
            toggleBookmarkButton(res.type);
            openBookmarkRegisterDialog('bookmark', res.type);
        })
        .fail(function(error) {
            openBookmarkRegisterDialog('bookmark');
        });
    });

    // ログイン済みユーザーがregister用ボタンをクリック時
    $('#sm-user-register-button, #md-user-register-button').on('click', function() {
        const url       = $('[name="register-url"]').val();
        const userId    = $('[name="user_id"]').val();
        const productId = $('[name="product_id"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: 'post',
            url: url,
            dataType: 'json',
            data: {
                'userId': userId,
                'productId': productId,
            },
            beforeSend: function() {
                $(this).attr('disabled');
            },
        })
        .done(function(res) {
            toggleRegisterButton(res.type);
            openBookmarkRegisterDialog('register', res.type);
        })
        .fail(function(error) {
            openBookmarkRegisterDialog('register');
        });
    });

    // 「もっと見る」ボタンクリック時
    $('#product-description-button').on('click', function() {
        // テキストが省略されている時(念のために入れている)
        if ($('#product-description').attr('style')) {
            $(this).remove(); // ボタンを削除
            $('#product-description').removeAttr('style'); // 全文表示
        }
    });
});
