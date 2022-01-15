// フッターに関する処理
$(function() {
    // 今年の西暦をcopyrightの部分に表示
    const date     = new Date();
    const thisYear = date.getFullYear();
    $('#footer-copyright-year').text(thisYear);
});
