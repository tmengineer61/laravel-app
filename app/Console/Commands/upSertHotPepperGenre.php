<?php

namespace App\Console\Commands;

use App\Libs\HotPepperApi;
use App\Models\Genre;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class upSertHotPepperGenre extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upsertHotPepperGenre';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'HotpepperAPIのジャンルマスタにリクエストしてジャンルを取得する';

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::setDefaultDriver('upsertHotPepperGenre');
        
        Log::info($this->signature . ': start '. date('Y/m/d H:i:s'));
        $params = [];
        $hotPepperApi = new HotPepperApi();

        $data = $hotPepperApi->getGenre($params);
        $genreList = $data['results']['genre'];

        $CGenre = new Genre();
        $insertParams = [];
        foreach ($genreList as $index => $genre) {
            $insertParams[$index] = [
                'genre_code' => $genre['code'],
                'title' => $genre['name'],
            ];

            // 画像がある場合のみ作成する
            if (isset(self::LARGE_GENRE_IMAGE[$genre['code']]) && !empty(self::LARGE_GENRE_IMAGE[$genre['code']])) {
                $insertParams[$index]['image1'] = self::LARGE_GENRE_IMAGE[$genre['code']];
            } else {
                $insertParams[$index]['image1'] = '';
            }
        }
        $upSertCount = $CGenre->upsert($insertParams, 'genre_code');
        Log::info('更新新規追加件数：' . $upSertCount);

        // TODO: スペシャルコードのジャンルをDB保持する
        Log::info($this->signature . ': End. ' . date('Y/m/d H:i:s'));
    }
}
