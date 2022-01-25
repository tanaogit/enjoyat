<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserResetPassword extends Notification
{
    public $token = "";

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
     * 通知メール作成
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

        return $this->buildMailMessage($notifiable, $url);
    }

    /**
     * メッセージを作成
     *
     * @param mixed $notifiable
     * @param string $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($notifiable, $url)
    {
        return (new MailMessage)
            ->subject('【Enjoyat】パスワードリセットのご案内')
            ->markdown('vendor.notifications.passwordreset-email', ['username' => $notifiable->username, 'url' => $url]);
    }
}
