@component('mail::verify-message', ['username' => $username, 'actionUrl' => $url])

# {{ $username }}さんの会員登録の申請を受け付けました。

この度は会員登録を申請いただき、誠にありがとうございます。

現在は仮登録の状態です。<br>
本会員登録を完了するには以下「本会員登録」ボタンをクリックして登録を完了させてください。

会員登録の申請に心当たりがない場合は、以降の対応は不要となりますのでメールの破棄をお願いいたします。

@component('mail::button', ['url' => $url, 'color' => 'primary'])
本会員登録
@endcomponent

本会員登録の有効期限は60分間となりますので期限内にご登録を完了してください。<br>
もし上記有効期限を過ぎてしまった場合は会員登録に関する情報は全て破棄されますので
お手数お掛けして大変申し訳ございませんが、再度仮登録より申請し直して下さい。

不明点等ございましたら以下のお問い合わせフォームよりご連絡ください。

※送信専用のメールアドレスのため直接の返信はできません。

@slot('subcopy')
Enjoyat<br>
URL:【決定後に設定】

お問い合わせフォーム:【決定後に設定】

Facebook:【決定後に設定】<br>
Twitter:【決定後に設定】
@endslot
@endcomponent
