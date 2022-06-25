<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\HotPepperApiService;

/**
 * Ajax用 Controller
 */
class AjaxController extends Controller
{

    /**
     * @var [HotPepperApiService]
     */
    private $hotPepperApiService;

    /**
     * コンストラクタ
     *
     * @param HotPepperApiService $hotPepperApiService
     */
    public function __construct(HotPepperApiService $hotPepperApiService)
    {
        $this->hotPepperApiService = $hotPepperApiService;
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
        // デフォルト1ページ目に設定
        $page = $request->filled('page') ? $request->page : 1;

        $shopCollection = $this->hotPepperApiService->searchShop($request);

        $shopList = new LengthAwarePaginator($shopCollection->forPage($page, config('config.PAGINATION.ITEM_PER_PAGE')), $shopCollection->count(), config('config.PAGINATION.ITEM_PER_PAGE'), $page, ['path' => '/']);

        $result['views'] = view('inc.shop_cards', ['shopList' => $shopList, 'lat' => $request->lat, 'lng' => $request->lng])->render();
        $result['status'] = true;

        return $result;
    }
}
