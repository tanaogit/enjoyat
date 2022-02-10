// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js');  // ダイアログ

$(function() {
    // メール送信ボタン押下時に表示する確認ダイアログ
    $('#send-confirm-dialog').dialog({
        title: 'メール再送信確認',
        autoOpen: false,
        width: 'auto',
        height: 'auto',
        modal: true,
        draggable: false,
        resizable: false,
        buttons: [
            {
              html: '<i class="fas fa-envelope"></i> 再送信',
              click: function() {
                $('#sending-dialog').dialog('open'); // メール送信中のダイアログを表示
                $('#resend-form').submit();          // メール送信処理
              }
            },
            {
              html: '<i class="fas fa-times"></i> キャンセル',
              click: function() {
                  $(this).dialog('close');
              }
            }
        ],
    });


    // メール送信中に表示するローディングアイコンのダイアログ
    $('#sending-dialog').dialog({
        title: 'メール送信中',
        autoOpen: false,
        width: 'auto',
        height: 'auto',
        modal: true,
        draggable: false,
        resizable: false,
        open: function() {
            // 右上のcloseボタンを除去
             $(this).prev().children('.ui-button').remove();
             // 要素に直接classをつけるとスマホでanimationしなかったためここで付ける
             $(this).find('.fas.fa-sync').addClass('animate-spin');
        }
    });

    // メール送信完了時に表示するダイアログ
    $('#sent-dialog').dialog({
        title: '送信結果',
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

    // ログアウトボタン押下時に表示されるダイアログ
    $('#logout-confirm-dialog').dialog({
        title: 'オーナーログアウト',
        autoOpen: false,
        width: 'auto',
        height: 'auto',
        modal: true,
        draggable: false,
        resizable: false,
        buttons: [
            {
                html: '<i class="fas fa-sign-out-alt"></i> ログアウト',
                click: function() {
                    $('#owner-logout-form').submit();
                },
            },
            {
                html: '<i class="fas fa-times"></i> キャンセル',
                click: function() {
                    $(this).dialog('close');
                },
            }
        ],
    });

    // メール送信ボタンクリック時にダイアログを表示
    $('#resend-button').on('click', function(e) {
        e.preventDefault();
        // 送信確認ダイアログを表示
        $('#send-confirm-dialog').dialog('open');
    });

    // ログアウトボタン押下時にダイアログを表示
    $('#owner-logout-button').on('click', function(e) {
        e.preventDefault();
        // ログアウト確認ダイアログを表示
        $('#logout-confirm-dialog').dialog('open');
    });
});
