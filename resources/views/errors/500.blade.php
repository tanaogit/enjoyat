<x-templates.error title="Internal Server Error" statusCode="500">
    <x-slot name="errorText">
        指定されたページは表示できませんでした。<br>
        現在メンテナンス中であるか、<br>
        アクセスが集中している可能性があります。<br>
        時間をおいて再度アクセスいただくか、<br>お手数ですが、<a href="{{ route('support.contact') }}" style="color: #0000ee" class="underline">お問い合わせフォーム</a>より<br class="sm:hidden">お問い合わせください。
    </x-slot>
</x-templates.error>
