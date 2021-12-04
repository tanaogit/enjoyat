<?php

if (! function_exists('is_mobile')) {
    /**
     * 引数に与えられる
     * ユーザーエージェント情報からモバイル端末か判定する処理
     *
     * @param  string  $user_agent
     * @return  bool
     */
    function is_mobile($user_agent)
    {
        if ((strpos($user_agent, 'Android') !== false) && (strpos($user_agent, 'Mobile') !== false) || (strpos($user_agent, 'iPhone') !== false) || (strpos($user_agent, 'Windows Phone') !== false)) {
            return true;
        } else {
            return false;
        }
    }
}

if (! function_exists('is_tablet')) {
    /**
     * 引数に与えられる
     * ユーザーエージェント情報からタブレット端末か判定する処理
     * ※ブラウザがsafariの場合falseを返す
     *
     * @param  string  $user_agent
     * @return  bool
     */
    function is_tablet($user_agent)
    {
        if ((strpos($user_agent, 'Android') !== false) && (strpos($user_agent, 'Mobile') === false) || (strpos($user_agent, 'iPad') !== false)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * アクセス元の端末がタブレットまたはPC、ブラウザがsafariの時を検出
 *
 * @return bool
 */
function is_tablet_pc_safari()
{
    // SPの場合
    if (is_mobile($_SERVER['HTTP_USER_AGENT'])) return false;

    // safari以外のタブレットの時
    if (is_tablet($_SERVER['HTTP_USER_AGENT'])) return false;

    // ブラウザがsafariのときtrueの返す
    return (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') === false);
}
