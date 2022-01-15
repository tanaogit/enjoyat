// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js'); // ダイアログ

$(function() {
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
                    $('.owner-logout-form').submit();
                },
            },
            {
                html: '<i class="fas fa-times"></i> キャンセル',
                click: function() {
                    $(this).dialog('close');
                    return false;
                },
            }
        ],
    });

    // ログアウトボタン押下時にダイアログを表示
    $('#pc-owner-logout-button, #sp-owner-logout-button').on('click', function(e) {
        e.preventDefault();
        $('#logout-confirm-dialog').dialog('open');
    });
});
