<?php

namespace App\Http\Controllers\ThirdPartyApi;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Http;

class ThirdPartyController extends BaseController
{
    //Get Data From External Api
    public function getDataFromExternalApi()
    {
        $response = Http::get('https://www.hawyatshipping.com/api/get-ports/Int-555');

        return $this->sendResponse($response->json());
    }

}
