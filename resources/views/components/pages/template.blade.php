@props(['title' => 'Enjoyat', 'style' => '', 'jsFile' => ''])
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

        {{-- styleタグを設定する --}}
        {{ $style }}
    </head>
    <body class="antialiased">
        {{ $slot }}

        {{-- JSファイルの読み込み --}}
        {{ $jsFile }}
    </body>
</html>
