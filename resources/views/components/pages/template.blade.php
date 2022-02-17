{{-- 主にトップページ以下認証なしで閲覧できるページに用いる --}}
{{-- ヘッダー及びフッターなどは固定 --}}
@props(['title' => 'Enjoyat', 'headerOption' => '', 'style' => '', 'jsFile' => ''])
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" sizes="180x180">
        <link rel="icon" type="image/png" href="{{ asset('android-touch-icon.png') }}" sizes="192x192">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        {{ $headerOption }}

        {{-- styleタグを設定する --}}
        {{ $style }}
    </head>
    <body class="antialiased">
        {{-- ヘッダー --}}
        <x-organisms.header />

        {{-- 各ページごとの内容 --}}
        {{ $slot }}

        {{-- ページ上部に戻るボタン --}}
        <x-atoms.buttons.scroll-top-button />

        {{-- フッター --}}
        <x-organisms.footer />

        {{-- ヘッダーで用いられるJSファイル --}}
        <script src="{{ mix('js/components/organisms/header.js') }}"></script>
        {{-- そのファイル独自のJSファイルの読み込み --}}
        {{ $jsFile }}
        {{-- スクロールボタンで用いられるJSファイル --}}
        <script src="{{ mix('js/components/atoms/buttons/scroll-top-button.js') }}"></script>
        {{-- フッターで用いられるJSファイル --}}
        <script src="{{ mix('js/components/organisms/footer.js') }}"></script>
    </body>
</html>
