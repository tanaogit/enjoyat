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

    // ハンバーガーメニュー開閉操作
    $('#pagesTemplateHumburgerMenus').on('click', function() {
        $('#pagesTemplateSpMenus').toggleClass('hidden');
    });

    // ログアウトボタン押下時にダイアログを表示
    $('#pc-owner-logout-button, #sp-owner-logout-button').on('click', function(e) {
        e.preventDefault();
        $('#logout-confirm-dialog').dialog('open');
    });

    // ページ上部に戻るボタン
    const scrollTopButton = $('#scroll-top-button');

    $(window).scroll(function() {
        const scrollTop = $(window).scrollTop();
        // 200px以上スクロールされたらボタンを表示
        if (scrollTop > 200) {
            scrollTopButton.show();
        } else {
            scrollTopButton.hide();
        }
    });

    scrollTopButton.on('click', function() {
        // 0.5秒かけてページ上部へ戻る
        $('body, html').animate({scrollTop: 0}, 500);
        return false;
    });
});
