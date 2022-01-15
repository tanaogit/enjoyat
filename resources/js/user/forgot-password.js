// jQuery UIの読み込み
require('jquery-ui/ui/widgets/tooltip.js'); // ツールチップ
require('jquery-ui/ui/widgets/dialog.js');  // ダイアログ

$(function() {
    // ツールチップ
    $(document).tooltip({
        position: {my: 'left+15 top+10'},
    });

    // メール送信ボタン押下時に表示するローディングアイコンのダイアログ
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

    // メール送信時に表示するダイアログ
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

    // メール送信ボタン押下時にローディングアイコンを表示
    $('#send-main-button').on('click', function() {
        // 送信中の場合
        if ($('#email:valid').length) {
            $('#sending-dialog').dialog('open');
        }
    });

    // バリデーション時に該当の入力箇所に色をつける
    if ($('#email_validation').length) {
        $('#email').addClass('border-red-400 border-2');
    }
});
