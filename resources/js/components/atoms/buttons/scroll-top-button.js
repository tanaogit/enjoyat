// スクロールボタンに関する処理
$(function() {
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
    });
});
