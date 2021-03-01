<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Libs\HotPepperApi;

class AjaxController extends Controller
{

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
            Log::info('バリデートに失敗しました。' . print_r($validator->errors(), true));
            return $result;
        }

        // 使用するパラメーターのみ指定
        $arrParams = [
            'lat' => $request->lat,
            'lng' => $request->lng,
            'genre' => $request->genre
        ];

        // 検索
        $HotPepperApi = new HotPepperApi();

        $data = $HotPepperApi->getGourmetShop($arrParams);
        $result['views'] = view('inc.shop_cards', ['shopList' => $data['results']['shop'], 'lat' => $request->lat, 'lng' => $request->lng])->render();
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
        ];
    }
}
