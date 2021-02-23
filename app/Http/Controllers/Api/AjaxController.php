<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Libs\HotPepperApi;

class AjaxController extends Controller
{
    public function searchShop(Request $request)
    {
        $result = [
            'status' => false,
            'views' => '',
        ];

        // TODO:バリデート

        // 検索
        $HotPepperApi = new HotPepperApi();

        $data = $HotPepperApi->getGourmetShop($request->all());
        $result['views'] = view('inc.shop_cards', ['shopList' => $data['results']['shop']])->render();
        $result['status'] = true;


        return $result;
    }
}
