<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ホーム</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div class="container">
        <div class="row bg-secondary text-white">
            <div class="col-xs-12 mx-auto">
                <div class="header">
                    <div class="title">
                        <h1>お店検索</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 mx-auto">
                <div class="contents">
                    <div class="search-condition mt-1">
                        <div class="cond-contents d-flex flex-wrap justify-content-center">
                            @foreach ($genreList as $genre)
                            <div class="cond-content mx-2 my-2">
                                <p class="cond-name">{{$genre['name']}}</p>
                                <a href="javascript:void(0)">
                                    <img src="{{asset($genre['img'])}}" class="cond-thumb is-opacity">
                                </a>
                                <input type="hidden" name="genre_code" value="{{$genre['code']}}" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="search mb-3">
                        <div class="description">
                            <p class="text-center">※取得には<span class="font-weight-bold bb-red">現在地</span>を使用します。</p>
                        </div>
                        <div class="button mb-3 mx-auto">
                            <button type="button" id="search" class="btn btn-outline-secondary btn-block">近くの店を検索する。</button>
                        </div>
                        <div id="shop">
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