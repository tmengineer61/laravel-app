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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div class="container">
        <div class="row bg-secondary text-white">
            <div class="col-xs-12 mx-auto">
                <div class="header">
                    <div class="title">
                        <h1>お店検索API</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 mx-auto">
                <div class="contents">
                    <div class="search">
                        <div class="description">
                            <p>近くの店を検索する</p>
                            <p>※取得には現在地を使用します。</p>
                        </div>
                        <div class="pb-3">
                            <button type="button" id="search" class="btn btn-outline-secondary btn-block">近くの店を検索する。</button>
                        </div>
                        <div id="shop">
                            <img src="{{ asset('/images/ajax-loading.gif') }}" class="ajax-load hide mx-auto" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-secondary text-white">
            <div class="col-xs-12 mx-auto">
                <div class="footer">
                    <a href="//webservice.recruit.co.jp/">
                        <img src="//webservice.recruit.co.jp/banner/hotpepper-s.gif"
                            alt="ホットペッパー Webサービス" width="135" height="17" border="0" title="ホットペッパー Webサービス">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('/js/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/home.js')}}?{{@filemtime('public_path("js/home.js")') }}"></script>
</body>

</html>