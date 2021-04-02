<?php

namespace App\Http\Controllers;

use App\Libs\HotPepperApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{


    const LARGE_GENRE_IMAGE = [
        'G001' => 'images/izakaya.jpeg',
        'G002' => '', // TODO: 画像見つける
        'G003' => '', // TODO: 画像見つける
        'G004' => '', // TODO: 画像見つける
        'G005' => '', // TODO: 画像見つける
        'G006' => '', // TODO: 画像見つける
        'G007' => '/images/tyuka.jpg', // TODO: 画像見つける
        'G008' => '/images/yakiniku.jpg',
        'G009' => '', // TODO: 画像見つける
        'G010' => '', // TODO: 画像見つける
        'G011' => '', // TODO: 画像見つける
        'G012' => '', // TODO: 画像見つける
        'G013' => '/images/ramen.png', 
        'G014' => '', // TODO: 画像見つける
        'G015' => '', // TODO: 画像見つける
        'G016' => '', // TODO: 画像見つける
        'G017' => '', // TODO: 画像見つける

    ];

    public function index(Request $request)
    {

        $params = $request->all();
        $hotPepperApi = new HotPepperApi();

        $data = $hotPepperApi->getGenre($params);
        $genreList = $data['results']['genre'];

        // ジャンルごとに成形
        $mainGenreList = [];
        $otherGenreList = [];
        foreach ($genreList as &$genre) {
            $genre['img'] = isset(self::LARGE_GENRE_IMAGE[$genre['code']]) ? self::LARGE_GENRE_IMAGE[$genre['code']] : '';
            if (!empty($genre['img'])) {
                $mainGenreList[] = $genre;
            } else {
                $otherGenreList[] = $genre;
            }
        }

        return view('home.index', ['mainGenreList' => $mainGenreList, 'otherGenreList' => $otherGenreList]);
    }
}
