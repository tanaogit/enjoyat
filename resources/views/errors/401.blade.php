<x-templates.error title="Unauthorized" statusCode="401">
    <x-slot name="errorText">
        指定されたページへの<br class="sm:hidden">アクセスには認証が必要です。<br>
        ログイン状況などをご確認の上、<br class="sm:hidden">再度アクセスしてください。<br>
        また、疑問点等ございましたら<br class="sm:hidden">本サービスの<br class="hidden sm:inline"><a href="{{ route('support.contact') }}" style="color: #0000ee" class="underline">お問い合わせフォーム</a>より<br class="sm:hidden">お問い合わせください。
    </x-slot>
</x-templates.error>
