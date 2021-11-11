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
});
