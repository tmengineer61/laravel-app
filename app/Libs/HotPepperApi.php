<?php

namespace App\Libs;

use App\Exceptions\ExternalApiException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Exception;

class HotPepperApi
{

    /** HotPepper グルメAPI */
    const GOURMET_API = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/';

    /** HotPepper ジャンルAPI */
    const GENRE_API = 'http://webservice.recruit.co.jp/hotpepper/genre/v1/';

    /** HotPepper 特集ジャンルカテゴリAPI */
    const SPECIAL_GENRE_API = 'http://webservice.recruit.co.jp/hotpepper/special/v1/';

    /**
     * 店舗を取得する
     * 
     * @param array $params パラメーター
     * @return array $json 取得結果
     * 
     */
    public function getGourmetShop(array $params)
    {
        $startTime = microtime(true);
        Log::info(__METHOD__ . ' START. $params=' . var_export($params, true));
        $requestParams = $params;
        $requestParams['key'] = config('config.RECRUIT_API_KEY');
        $requestParams['format'] = 'json';

        try {
            // 第2引数に、パラメーターすべて含める
            $response = Http::timeout(config('config.HOTPEPPER_API.TIMEOUT'))
                ->retry(config('config.HOTPEPPER_API.RETRY.TIMES'), config('config.HOTPEPPER_API.RETRY.WAIT'))
                ->get(self::GOURMET_API, $requestParams);
    
            $json = $response->json();
        } catch(Exception $e) {
            Log::error('リクエストに失敗しました。' . $e->getMessage());
            throw new ExternalApiException('Hotpepper Gourmet Api Error.');
        } finally {
            $endTime = microtime(true);
            Log::info(__METHOD__ . ' END. time:' . $endTime - $startTime . '秒');
        }

        return $json;
    }

    /**
     * ジャンルを取得する
     * 
     * @param array $params 検索パラメーター
     * @return array $json ジャンル
     * 
     */
    public function getGenre(array $params)
    {
        $startTime = microtime(true);
        Log::info(__METHOD__ . ' START. $params=' . var_export($params, true));

        $requestParams = $params;
        $requestParams['key'] = config('config.RECRUIT_API_KEY');
        $requestParams['format'] = 'json';

        try {
            // 第2引数に、パラメーターすべて含める
            $response = Http::timeout(config('config.HOTPEPPER_API.TIMEOUT'))
                ->retry(config('config.HOTPEPPER_API.RETRY.TIMES'), config('config.HOTPEPPER_API.RETRY.WAIT'))
                ->get(self::GENRE_API, $requestParams);
    
            $json = $response->json();    
        } catch(Exception $e) {
            Log::error('リクエストに失敗しました。' . $e->getMessage());
            return $e;
        } finally {
            $endTime = microtime(true);
            Log::info(__METHOD__ . ' END. time:' . $endTime - $startTime . '秒');
        }

        return $json;   
    }

    /**
     * 特集ジャンルを取得する
     * 
     * @param array $params 検索パラメーター
     * @return array $json ジャンル
     * 
     */
    public function getSpecialGenre(array $params)
    {
        $startTime = microtime(true);
        Log::info(__METHOD__ . ' START. $params=' . var_export($params, true));

        $requestParams = $params;
        $requestParams['key'] = config('config.RECRUIT_API_KEY');
        $requestParams['format'] = 'json';

        try {
            // 第2引数に、パラメーターすべて含める
            $response = Http::timeout(config('config.HOTPEPPER_API.TIMEOUT'))
                ->retry(config('config.HOTPEPPER_API.RETRY.TIMES'), config('config.HOTPEPPER_API.RETRY.WAIT'))
                ->get(self::SPECIAL_GENRE_API, $requestParams);
    
            $json = $response->json();    
        } catch(Exception $e) {
            Log::error('リクエストに失敗しました。' . $e->getMessage());
            return $e;
        } finally {
            $endTime = microtime(true);
            Log::info(__METHOD__ . ' END. time:' . $endTime - $startTime . '秒');
        }

        return $json;   
    }
}
