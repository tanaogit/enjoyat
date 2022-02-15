$(function() {
    // 各口コミに対して基準となる文字数
    let maxtextLength = 210;
    if (window.innerWidth > 1536) {
        // 画面幅が2xl以上の時
        maxtextLength = 400;
    } else if (window.innerWidth > 1280) {
        // 画面幅がxl以上の時
        maxtextLength = 300;
    } else if (window.innerWidth > 1024) {
        // 画面幅がlg以上の時
        maxtextLength = 250;
    } else if (window.innerWidth > 768) {
        // 画面幅がmd以上の時
        maxtextLength = 230;
    }

    // 各口コミに対して基準の文字数を超えていたら省略をする
    $('.post-message').each(function() {
        const textLength = $(this).text().length;
        // 基準となる文字数を超えたら三点リーダーで隠す
        if (textLength > maxtextLength) {
            $(this).css({
                'display': '-webkit-box',
                '-webkit-box-orient': 'vertical',
                '-webkit-line-clamp': '4',
                'overflow': 'hidden',
            });
            $(this).next('.post-message-button').show();
        }
    });

    // 各口コミ本文の「もっと見る」ボタンクリック時
    $('.post-message-button').on('click', function() {
        // テキストが省略されている時(念のために入れている)
        if ($(this).prev('.post-message').attr('style')) {
            $(this).prev('.post-message').removeAttr('style'); // 全文表示
            $(this).remove(); // ボタンを削除
        }
    });
});
