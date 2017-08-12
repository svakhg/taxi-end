<?php

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\CallCode;
use App\Taxi;
use App\Company;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'configure'], function () {
        Route::get('company/view', function (Request $request) {
            $id = $request->id;
            $info = Company::find($id);
            //echo json_decode($info);
            return response()->json($info);
        });
        Route::get('taxi-center/view', function (Request $request) {
            $id = $request->id;
            $info = TaxiCenter::find($id);
            $info2 = Company::find($info->company_id);
            $info->company = $info2;
            //echo json_decode($info);
            return response()->json($info);
        });
        Route::get('call-code/view', function (Request $request) {
            $id = $request->id;
            $info = CallCode::find($id);
            $info2 = TaxiCenter::find($info->center_id);
            $info->center = $info2;
            //echo json_decode($info);
            return response()->json($info);
        });
        Route::get('taxi/view', function (Request $request) {
            $id = $request->id;
            $info = Taxi::find($id);
            $info2 = CallCode::find($info->callcode_id);
            $info3 = TaxiCenter::find($info2->center_id);
            $info4 = Company::find($info3->company_id);
            $info->callcode = $info2;
            $info->texicenter = $info3;
            $info->company = $info4;
            //echo json_decode($info);
            return response()->json($info);
        });
    });
});           