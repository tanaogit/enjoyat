$(function() {
    // 「お店の紹介」の文章の文字数を取得
    const textLength = $('#store-introduction').text().length;
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
        $('#store-introduction').css({
            'display': '-webkit-box',
            '-webkit-box-orient': 'vertical',
            '-webkit-line-clamp': '4',
            'overflow': 'hidden',
        });
        $('#store-introduction-button').show();
    }

    // 「もっと見る」ボタンクリック時
    $('#store-introduction-button').on('click', function() {
        // テキストが省略されている時(念のために入れている)
        if ($('#store-introduction').attr('style')) {
            $(this).remove(); // ボタンを削除
            $('#store-introduction').removeAttr('style'); // 全文表示
        }
    });
});
