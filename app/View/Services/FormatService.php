<?php

namespace App\View\Services;

class FormatService
{
    /**
     * アクセスに関して検索条件に応じたタイトルを返す
     *
     * @param  string $pref
     * @param  string $line
     * @param  string $station
     * @return string $title_str
     */
    public function getTitleForAccess($pref, $line, $station)
    {
        $title_str = '';
        if (!empty($line)) {
            // 路線の条件がある時
            if (!empty($station)) {
                // 駅の検索条件がある時
                $title_str = $line . 'の' . $station . '駅付近の店舗';
            } else {
                $title_str = $pref . 'の' . $line . '付近の店舗';
            }
        } else {
            if (!empty($pref)) {
                // 都道府県の検索条件がある時
                $title_str = $pref . 'の店舗';
            } else {
                // 検索条件未入力の時
                $title_str = '全ての店舗';
            }
        }

        return $title_str;
    }

    /**
     * 曜日を日本語で返す
     *
     * @param  array $days
     * @return array $daysInJapanese
     */
    public function getDaysInJapanese($days)
    {
        $daysInJapanese = []; // 曜日を日本語化した配列

        // 空で返す
        if (!is_array($days)) return $daysInJapanese;

        $dayArray = [
            'sunday'    => '日曜日',
            'monday'    => '月曜日',
            'tuesday'   => '火曜日',
            'wednesday' => '水曜日',
            'thursday'  => '木曜日',
            'friday'    => '金曜日',
            'saturday'  => '土曜日',
        ];

        foreach ($days as $day) {
            // 念のために小文字化した後に該当の曜日を取得する
            $lowerDay = strtolower($day);
            if (array_key_exists($lowerDay, $dayArray)) {
                $daysInJapanese[] = $dayArray[$lowerDay];
            }
        }

        return $daysInJapanese;
    }

    /**
     * クーポンに関する検索条件を日本語で返す
     *
     * @param  string $condition
     * @return string $text
     */
    public function getCouponCondition($condition)
    {
        $text = '';
        if (is_null($condition)) {
            $text = '指定なし';
        } elseif ($condition === '0') {
            $text = '無';
        } elseif ($condition === '1') {
            $text = '有';
        }

        return $text;
    }
}
