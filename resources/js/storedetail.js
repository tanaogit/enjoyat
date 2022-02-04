$(function() {
    // 「もっと見る」ボタンクリック時
    $('#store-introduction-button').on('click', function() {
        // テキストが省略されている時(念のために入れている)
        if ($('#store-introduction').attr('style')) {
            $(this).remove(); // ボタンを削除
            $('#store-introduction').removeAttr('style'); // 全文表示
        }
    });
});
