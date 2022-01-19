<x-templates.error title="Forbidden" statusCode="403">
    <x-slot name="errorText">
        指定されたページへの<br class="sm:hidden">アクセスは禁止されています。<br>
        URLにお間違いがないか、<br class="sm:hidden">再度ご確認ください。<br>
        また、疑問点等ございましたら<br class="sm:hidden">本サービスの<br class="hidden sm:inline"><a href="{{ route('support.contact') }}" style="color: #0000ee" class="underline">お問い合わせフォーム</a>より<br class="sm:hidden">お問い合わせください。
    </x-slot>
</x-templates.error>
