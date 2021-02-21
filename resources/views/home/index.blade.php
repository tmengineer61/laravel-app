<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ホーム</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css')}}?{{@filemtime('public_path("css/main.css")') }}">
</head>

<body>
    <div class="main">
        <div class="header">

        </div>
        <div class="contents">
            <div class="search">
                <div class="description">
                    <h1>近くの店を検索する</h1>
                    <p>取得には現在地を使用します。</p>
                </div>
                <button id="search">近くの店を検索する。</button>
                <div id="shop">
                    <img src="{{ asset('/images/ajax-loading.gif') }}" class="ajax-load hide"/>
                </div>
            </div>
        </div>
        <div class="footer">
            <a href="http://webservice.recruit.co.jp/"><img src="http://webservice.recruit.co.jp/banner/hotpepper-s.gif" alt="ホットペッパー Webサービス" width="135" height="17" border="0" title="ホットペッパー Webサービス"></a>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('/js/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/home.js')}}?{{@filemtime('public_path("js/home.js")') }}"></script>
</body>

</html>