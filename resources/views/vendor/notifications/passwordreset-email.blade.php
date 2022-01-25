@component('mail::passwordreset-message', ['username' => $username, 'actionUrl' => $url])

# {{ $username }}さんのパスワードリセット申請を受け付けました。

以下「パスワードリセット」ボタンをクリックして新しいパスワードをご登録ください。

パスワードリセットの申請に心当たりがない場合は、以降の対応は不要となりますのでメールの破棄をお願いいたします。

{{-- Action Button --}}
@component('mail::button', ['url' => $url, 'color' => 'primary'])
パスワードリセット
@endcomponent

パスワードリセットの有効期限は60分間となりますので期限内にご登録を完了してください。

不明点等ございましたら以下のお問い合わせフォームよりご連絡ください。

※送信専用のメールアドレスのため直接の返信はできません。

{{-- Subcopy --}}
@slot('subcopy')
Enjoyat<br>
URL:【決定後に設定】

お問い合わせフォーム:【決定後に設定】

Facebook:【決定後に設定】<br>
Twitter:【決定後に設定】
@endslot
@endcomponent
