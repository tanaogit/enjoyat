// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js'); // ダイアログ

$(function() {
    // ログアウトボタン押下時に表示されるダイアログ
    $('#logout-confirm-dialog').dialog({
        title: 'ユーザーログアウト',
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
                    $('.user-logout-form').submit();
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
    $('#pc-user-logout-button, #sp-user-logout-button').on('click', function(e) {
        e.preventDefault();
        $('#logout-confirm-dialog').dialog('open');
    });
});
