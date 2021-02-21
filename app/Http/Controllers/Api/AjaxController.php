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
            'status' => true,
            'views' => '',
            'data' => []
        ];

        // TODO:バリデート

        // 検索
        $HotPepperApi = new HotPepperApi();

        $result['data'] = $HotPepperApi->getGourmetShop($request->all());

        return $result;
    }
}
