@props(['title' => 'Enjoyat', 'style' => '', 'jsFile' => ''])
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

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
