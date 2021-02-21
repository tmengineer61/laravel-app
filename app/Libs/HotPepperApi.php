<?php

namespace App\Libs;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Exception;

class HotPepperApi
{

    /** HotPepper グルメAPI */
    const GOURMET_API = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/';

    /**
     * 店舗を取得する
     * 
     * @param array $params パラメーター
     * @return array $json 取得結果
     * 
     */
    public function getGourmetShop($params)
    {
        $requestParams = $params;
        $requestParams['key'] = config('config.RECRUIT_API_KEY');
        $requestParams['format'] = 'json';

        try {
            // 第2引数に、パラメーターすべて含める
            $response = Http::get(self::GOURMET_API, $requestParams);
    
            $json = $response->json();    
        } catch(Exception $e) {
            // TODO: ログ出力
            Log::error('リクエストに失敗しました。' . $e->getMessage());
            return $e;
        }

        return $json;
    }
}
