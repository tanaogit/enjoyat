// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js'); // ダイアログ

// ヘッダーに関する処理
$(function() {
    // SPメニュー開閉処理
    function toggleSpMenu() {
        $('#pagesTemplateHumburgerMenus').toggleClass('hidden');     // ハンバーガーメニューの表示・非表示
        $('#header-owner-icon').toggleClass('hidden');               // アイコンの表示・非表示
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

        // オーナーアイコンメニューを閉じる判定(アイコン以外が押された時に閉じる)
        if (!$('#header-owner-icon-menu').hasClass('hidden')) { // メニューが表示されている時
            // オーナーアイコンクリック時
            if (e.target.closest('#header-owner-icon') !== null) {
                return false;
            }
            // アイコン以外の部分がクリックされた時
            if (e.target.closest('#header-owner-icon-menu') === null) {
                $('#header-owner-icon-menu').addClass('hidden');
            }
        }
    });

    // ハンバーガーメニュークリック時
    $('#pagesTemplateHumburgerMenus').on('click', function() {
        // オーナーアイコンのメニューが表示されていれば非表示にする
        if (!$('#header-owner-icon-menu').hasClass('hidden')) {
            $('#header-owner-icon-menu').addClass('hidden');
        }
        toggleSpMenu();
    });

    // オーナーアイコンクリック時
    $('#header-owner-icon').on('click', function() {
        $('#header-owner-icon-menu').toggleClass('hidden');
    });


    // 店舗変更ダイアログ
    $('#change-store-dialog').dialog({
        title: '店舗変更',
        autoOpen: false,
        width: 'auto',
        height: 'auto',
        modal: true,
        draggable: false,
        resizable: false,
        buttons: [
            {
                html: '<i class="fas fa-exchange-alt"></i> 変更する',
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

    // 店舗変更ボタン押下時
    $('#sp-owner-changeStore-button, #pc-owner-changeStore-button').on('click', function() {
        // オーナーアイコンのメニューが表示されていれば非表示にする
        if (!$('#header-owner-icon-menu').hasClass('hidden')) {
            $('#header-owner-icon-menu').addClass('hidden');
        }
        $('#change-store-dialog').dialog('open');
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
        // オーナーアイコンのメニューが表示されていれば非表示にする
        if (!$('#header-owner-icon-menu').hasClass('hidden')) {
            $('#header-owner-icon-menu').addClass('hidden');
        }
        $('#logout-confirm-dialog').dialog('open');
    });
});
