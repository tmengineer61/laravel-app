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
        return view('home.index', ['genreList' => $genreList]);
    }
}
