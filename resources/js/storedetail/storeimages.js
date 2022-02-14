// jQuery UIの読み込み
require('jquery-ui/ui/widgets/dialog.js');  // ダイアログ

$(function() {
    // 写真クリック時に拡大表示するダイアログ
    $('#storeimage-dialog').dialog({
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
              }
            }
        ],
    });

    // 写真のうちいずれかをクリックしたときその写真を拡大表示する
    $('.storeimage-area').on('click', function() {
        let dialogSize;
        // 画面幅のうち小さい方を基準にする
        if (window.innerWidth > window.innerHeight) {
            dialogSize = window.innerHeight;
        } else {
            dialogSize = window.innerWidth;
        }

        let dialogRatio = 0.8;
        // 画面横幅に応じてダイアログの割合を変える
        if (window.innerWidth > 1024) {
            // 画面幅がlg以上の時
            dialogRatio = 0.6;
        } else if (window.innerWidth > 768) {
            // 画面幅がmd以上の時
            dialogRatio = 0.7;
        }

        // 写真に設定する一辺の長さ((画面幅の基準) × (割合)で写真のサイズを決定)
        const dialogImageSize = dialogSize * dialogRatio;

        $('#storeimage-dialog-image').css({
            'width': dialogImageSize,
            'height': dialogImageSize,
        });

        // ダイアログ及び写真の設定
        const storeimageCreatedAt = $(this).data('storeimage-created_at');
        const storeimageSrc       = $(this).data('storeimage-src');
        const titleText           = storeimageCreatedAt + 'の投稿';
        $('#storeimage-dialog').dialog('option', 'title', titleText); // タイトルを設定
        $('#storeimage-dialog-image').attr('src', storeimageSrc);     // 写真を設定

        $('#storeimage-dialog').dialog('open');
    });
});
