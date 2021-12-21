<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * チャンネル取得
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * メール作成
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('user.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return $this->buildMailMessage($url);
    }

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('【Enjoyat】パスワードリセットのご案内')
            ->greeting('Enjoyatのパスワードリセット申請を受け付けました。')
            ->line('以下「パスワードリセット」ボタンをクリックして新しいパスワードをご登録ください。')
            ->line('パスワードリセットの申請に心当たりがない場合は、以降の対応は不要となりますのでメールの破棄をお願いいたします。')
            ->action('パスワードリセット', $url)
            ->line('パスワードリセットの有効期限は60分間となりますので期限内にご登録を完了してください。')
            ->line('不明点等ございましたら以下のお問合せフォームよりご連絡ください。')
            ->line('※送信専用のメールアドレスのため直接の返信はできません。');
    }
}
