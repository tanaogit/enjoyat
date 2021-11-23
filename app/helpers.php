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
