<?php

namespace App\Http\Controllers;

use App\Libs\HotPepperApi;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        // DBからジャンルリストを取得
        $CGenre = new Genre();
        $genreList = $CGenre->select([
            'm_genres.genre_code',
            'm_genres.title',
            'm_genres.image1',
        ])->get();

        // ジャンルごとに成形
        $mainGenreList = [];
        $otherGenreList = [];
        foreach ($genreList as &$genre) {
            if (!empty($genre['image1'])) {
                $mainGenreList[] = $genre;
            } else {
                $otherGenreList[] = $genre;
            }
        }

        return view('home.index', ['mainGenreList' => $mainGenreList, 'otherGenreList' => $otherGenreList]);
    }
}
