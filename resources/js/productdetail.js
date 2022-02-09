$(function() {
    // 「サブスクの紹介」の文章の文字数を取得
    const textLength = $('#product-description').text().length;
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
        $('#product-description').css({
            'display': '-webkit-box',
            '-webkit-box-orient': 'vertical',
            '-webkit-line-clamp': '4',
            'overflow': 'hidden',
        });
        $('#product-description-button').show();
    }

    // 「もっと見る」ボタンクリック時
    $('#product-description-button').on('click', function() {
        // テキストが省略されている時(念のために入れている)
        if ($('#product-description').attr('style')) {
            $(this).remove(); // ボタンを削除
            $('#product-description').removeAttr('style'); // 全文表示
        }
    });
});
