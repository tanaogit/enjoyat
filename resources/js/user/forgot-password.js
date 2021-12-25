// jQuery UIの読み込み
require('jquery-ui/ui/widgets/tooltip.js'); // ツールチップ
require('jquery-ui/ui/widgets/dialog.js');  // ダイアログ

$(function() {
    // ツールチップ
    $(document).tooltip({
        position: {my: 'left+15 top+10'},
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

    // ハンバーガーメニュー開閉操作
    $('#pagesTemplateHumburgerMenus').on('click', function() {
        $('#pagesTemplateSpMenus').toggleClass('hidden');
    });

    // バリデーション時に該当の入力箇所に色をつける
    if ($('#email_validation').length) {
        $('#email').addClass('border-red-400 border-2');
    }
});
