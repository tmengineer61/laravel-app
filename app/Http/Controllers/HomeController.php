<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $genreList = [
            [
                'name' => '焼肉',
                'img' => '/images/yakiniku.jpg',
                'code' => 'G008'
            ],
            [
                'name' => 'ラーメン',
                'img' => '/images/ramen.png',
                'code' => 'G013',
            ],
            [
                'name' => '中華',
                'img' => '/images/tyuka.jpg',
                'code' => 'G007'
            ],
        ];

        $otherGenreList = [
            [
                'name' => '居酒屋',
                'code' => 'G001'
            ],
            [
                'name' => 'ダイニングバー・バル',
                'code' => 'G002'
            ],
            [
                'name' => '創作料理',
                'code' => 'G004'
            ],
            [
                'name' => '洋食',
                'code' => 'G005'
            ],
            [
                'name' => 'イタリアン・フレンチ',
                'code' => 'G006'
            ],
            [
                'name' => '韓国料理',
                'code' => 'G017'
            ],
            [
                'name' => 'アジア・エスニック料理',
                'code' => 'G009'
            ],
            [
                'name' => '各国料理',
                'code' => 'G010'
            ],
            [
                'name' => 'カラオケ・パーティ',
                'code' => 'G011'
            ],
            [
                'name' => 'バー・カクテル',
                'code' => 'G012'
            ],
            [
                'name' => 'お好み焼き・もんじゃ',
                'code' => 'G016'
            ],
            [
                'name' => 'カフェ・スイーツ',
                'code' => 'G014'
            ],
            [
                'name' => 'その他グルメ',
                'code' => 'G015'
            ],
        ];
        return view('home.index', ['genreList' => $genreList, 'otherGenreList' => $otherGenreList]);
    }
}
