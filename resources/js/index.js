$(function() {
    // ハンバーガーメニュー開閉操作
    $('#pagesTemplateHumburgerMenus').on('click', function() {
        $('#pagesTemplateSpMenus').toggleClass('hidden');
    });

    // 簡易検索欄の処理
    // APIから都道府県を取得
    $.getJSON('http://express.heartrails.com/api/json?method=getPrefectures', function(data) {
        // 全ての都道府県を取得
        const getPrefectures = data.response.prefecture;
        getPrefectures.forEach(function(getPrefecture) {
            $('#simple-search-panel_pref').append('<option value="' + getPrefecture + '">' + getPrefecture + '</option>');
        });
    });

    // 都道府県選択欄変更時に路線を取得
    $('#simple-search-panel_pref').on('change', function() {
        $.getJSON('http://express.heartrails.com/api/json?method=getLines&callback=?', {prefecture: $('#simple-search-panel_pref').val()},
        function(data) {
            // 路線欄の「路線を選択してください」以外を消す
            $('#simple-search-panel_line').children().not(':first').remove();
            // 駅名欄の「駅を選択してください」以外を消す
            $('#simple-search-panel_station').children().not(':first').remove();
            // 都道府県に紐づく路線を全て取得
            const getLines = data.response.line;
            getLines.forEach(function(getLine) {
                $('#simple-search-panel_line').append('<option value="' + getLine + '">' + getLine + '</option>');
            });
        });
    });

    // 路線選択欄変更時に駅を取得
    $('#simple-search-panel_line').on('change', function() {
        $.getJSON('http://express.heartrails.com/api/json?method=getStations&callback=?', {line: $('#simple-search-panel_line').val()},
        function(data) {
            // 駅名欄の「駅を選択してください」以外を消す
            $('#simple-search-panel_station').children().not(':first').remove();
            // 駅名を全て取得
            const getStations = data.response.station;
            getStations.forEach(function(getStation) {
                // 駅の中から選択した都道府県の中にあるものだけを取得
                if ($('#simple-search-panel_pref').val() === getStation.prefecture) {
                    $('#simple-search-panel_station').append('<option value="' + getStation.name + '">' + getStation.name + '</option>');
                }
            });
        });
    });

    // 「検索条件を追加する」ボタン
    $('#add-detail-button').on('click', function() {
        // URL変更処理
        let url = $('#search-form').attr('action');
        url = url.replace('simplesearch', 'detailsearch');
        $('#search-form').attr('action', url);

        // 「検索条件を追加する」ボタンを非表示
        $('#add-detail-options').addClass('hidden');
        // 「検索条件を絞る」ボタンを表示
        $('#remove-detail-options').removeClass('hidden');
        // 詳細検索の項目を表示
        $('#detail-search-options').removeClass('hidden');
    });

    //「検索条件を絞る」ボタン
    $('#remove-detail-button').on('click', function() {
        // URL変更処理
        let url = $('#search-form').attr('action');
        url = url.replace('detailsearch', 'simplesearch');
        $('#search-form').attr('action', url);

        // 「検索条件を絞る」ボタンを非表示
        $('#remove-detail-options').addClass('hidden');
        // 「検索条件を追加する」ボタンを表示
        $('#add-detail-options').removeClass('hidden');
        // 詳細検索の項目を非表示
        $('#detail-search-options').addClass('hidden');
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
