<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ホーム</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('slick/slick.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('slick/slick-theme.css') }}" rel="stylesheet" media="screen">

</head>

<body>
    <div class="container">
        <div class="row header-row bg-secondary text-white">
            <div class="col-xs-12 mx-auto">
                <div class="header">
                    <div class="title">
                        <h1 class="mt-2">お店検索</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row main-row">
            <div class="col-xs-12 mx-auto">
                <div class="contents">
                    <div class="search-condition mt-1">
                        <div class="cond-contents d-flex flex-wrap justify-content-center slider">
                            @foreach ($mainGenreList as $genre)
                            <div class="cond-content mx-2 my-2">
                                <p class="cond-name">{{$genre['title']}}</p>
                                <a href="javascript:void(0)">
                                    <img src="{{asset($genre['image1'])}}" class="cond-thumb is-opacity">
                                </a>
                                <input type="hidden" name="genre_code" value="{{$genre['genre_code']}}" />
                            </div>
                            @endforeach
                            <div class="cond-content is-modal mx-2 my-2">
                                <p class="cond-name">その他</p>
                                <!-- Button trigger modal -->
                                <a href="#otherGenreModal" data-toggle="modal" data-target="#otherGenreModal">
                                    <img src="{{asset('/images/other.png')}}" class="cond-thumb is-opacity">
                                </a>
                                <input type="hidden" name="genre_code" value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search mb-3">
                    <div class="description">
                        <p class="text-center">※取得には<span class="font-weight-bold bb-red">現在地</span>を使用します。</p>
                    </div>
                    <div class="button mb-3 mx-auto">
                        <button type="button" id="search"
                            class="btn btn-outline-secondary btn-block">近くの店を検索する。</button>
                    </div>
                    <div id="shop">
                    </div>
                </div>
            </div>
        </div>
        <div class="row footer-row bg-secondary text-white">
            <div class="col-xs-12 mx-auto">
                <div class="footer">
                    <a href="//webservice.recruit.co.jp/">
                        <img src="//webservice.recruit.co.jp/banner/hotpepper-s.gif" alt="ホットペッパー Webサービス" width="135"
                            height="17" border="0" title="ホットペッパー Webサービス">
                    </a>
                </div>
            </div>
        </div>
        @include('inc.other_genre')
    </div>
    <input type="hidden" name="lat" id="lat" value="">
    <input type="hidden" name="lng" id="lng" value="">
    <script type="text/javascript" src="{{asset('/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('js/common/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('/js/home.js')}}?{{@filemtime('public_path("js/home.js")') }}"></script>
</body>

</html>