<?php

namespace App\Services;

use App\Exceptions\ExternalApiException;
use App\Libs\HotPepperApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Validators\HotPepperValidator;

class HotPepperApiService {

    /**
     * HotPepperAPi 
     */
    private $hotPepperApi;

    /**
     * バリデーター
     *
     * @var [HotPepperValidator]
     */
    private $hotPepperValidator;

    /**
     * コンストラクタ
     */
    public function __construct(HotPepperApi $hotPepperApi, HotPepperValidator $hotPepperValidator)
    {
        $this->hotPepperApi = $hotPepperApi;
        $this->hotPepperValidator = $hotPepperValidator;
    }

    /**
     * HotPepperAPIを使用して、近くの店舗を検索する
     * 
     * @param Request $request リクエストパラメーター
     * @return array $result 返却値
     */
    public function searchShop(Request $request): Collection
    {
        $shopCollection = new Collection();

        $validator = Validator::make($request->all(), $this->hotPepperValidator->getSearchShopValidateRules());

        if ($validator->fails()) {
            Log::error('バリデートに失敗しました。' . print_r($validator->errors(), true));
            return $shopCollection;
        }

        // 使用するパラメーターのみ指定
        $arrParams = [
            'lat' => $request->lat,
            'lng' => $request->lng,
            'genre' => $request->genre,
            'count' => 100
        ];

        try {
            // 検索
            $data = $this->hotPepperApi->getGourmetShop($arrParams);
        } catch (ExternalApiException $e) {
            throw $e;
        }

        if (!isset($data['results']['shop']) || empty($data['results']['shop'])) {
            Log::error('APIの取得に失敗しました。');
            return $shopCollection;       
        }

        $shopCollection = new Collection($data['results']['shop']);

        return $shopCollection;
    }
}

