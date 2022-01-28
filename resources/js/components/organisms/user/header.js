// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js'); // ダイアログ

// ヘッダーに関する処理
$(function() {
    // SPメニュー開閉処理
    function toggleSpMenu() {
        $('#pagesTemplateHumburgerMenus').toggleClass('hidden');     // ハンバーガーメニューの表示・非表示
        $('#header-user-icon').toggleClass('hidden');                // アイコンの表示・非表示
        $('#pagesTemplateSpMenus').toggleClass('-translate-x-full'); // メニューの表示・非表示
        $('body, header').toggleClass('bg-gray-400');                // メニュー以外の部分の色を変える
    }

    $(document).on('click', function(e) {
        // SPメニューの閉じる判定(メニュー外が押された時に閉じる)
        if (!$('#pagesTemplateSpMenus').hasClass('-translate-x-full')) { // SPのメニューが表示されている時
            // ハンバーガーメニュークリック時(SPメニューを開く動作)
            if (e.target.closest('#pagesTemplateHumburgerMenus') !== null) {
                return false;
            }
            // メニュー以外の部分がクリックされた時
            if (e.target.closest('#pagesTemplateSpMenus') === null) {
                toggleSpMenu();
                return false;
            }
        }

        // ユーザーアイコンメニューを閉じる判定(アイコン以外が押された時に閉じる)
        if (!$('#header-user-icon-menu').hasClass('hidden')) { // メニューが表示されている時
            // ユーザーアイコンクリック時
            if (e.target.closest('#header-user-icon') !== null) {
                return false;
            }
            // アイコン以外の部分がクリックされた時
            if (e.target.closest('#header-user-icon-menu') === null) {
                $('#header-user-icon-menu').addClass('hidden');
            }
        }
    });

    // ハンバーガーメニュークリック時
    $('#pagesTemplateHumburgerMenus').on('click', function() {
        // ユーザーアイコンのメニューが表示されていれば非表示にする
        if (!$('#header-user-icon-menu').hasClass('hidden')) {
            $('#header-user-icon-menu').addClass('hidden');
        }
        toggleSpMenu();
    });

    // ユーザーアイコンクリック時
    $('#header-user-icon').on('click', function() {
        $('#header-user-icon-menu').toggleClass('hidden');
    });

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
        // ユーザーアイコンのメニューが表示されていれば非表示にする
        if (!$('#header-user-icon-menu').hasClass('hidden')) {
            $('#header-user-icon-menu').addClass('hidden');
        }
        $('#logout-confirm-dialog').dialog('open');
    });
});
