<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Libs\HotPepperApi;

class AjaxController extends Controller
{

    /**
     * HotPepperAPi 
     */
    private $hotPepperApi;

    /**
     * コンストラクタ
     */
    public function __construct(HotPepperApi $hotPepperApi)
    {
        $this->hotPepperApi = $hotPepperApi;
        
    }

    /**
     * HotPepperAPIを使用して、近くの店舗を検索する
     * 
     * @param Request $request リクエストパラメーター
     * @return array $result 返却値
     */
    public function searchShop(Request $request)
    {
        $result = [
            'status' => false,
            'views' => '',
        ];

        $validator = Validator::make($request->all(), $this->getValidateRules());

        if ($validator->fails()) {
            Log::error('バリデートに失敗しました。' . print_r($validator->errors(), true));
            return $result;
        }

        // 使用するパラメーターのみ指定
        $arrParams = [
            'lat' => $request->lat,
            'lng' => $request->lng,
            'genre' => $request->genre,
            'count' => 100
        ];

        // デフォルト1ページ目に設定
        $page = $request->filled('page') ? $request->page : 1;
        // 検索
        $data = $this->hotPepperApi->getGourmetShop($arrParams);

        if (!isset($data['results']['shop']) || empty($data['results']['shop'])) {
            Log::error('APIの取得に失敗しました。');
            return $result;       
        }

        $shopCollection = new Collection($data['results']['shop']);
        $shopList = new LengthAwarePaginator($shopCollection->forPage($page, config('config.PAGINATION.ITEM_PER_PAGE')), $shopCollection->count(), config('config.PAGINATION.ITEM_PER_PAGE'), $page, ['path' => '/']);

        $result['views'] = view('inc.shop_cards', ['shopList' => $shopList, 'lat' => $request->lat, 'lng' => $request->lng])->render();
        $result['status'] = true;


        return $result;
    }

    /**
     * バリデートルール
     * 
     * @return array バリデートルール
     */
    private function getValidateRules()
    {
        return [
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'genre' => ['nullable', 'regex:/^G0/'],
            'page' => ['nullable', 'numeric'],
        ];
    }
}
