<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('deposit', function (Request $request) {

    // check if bearer token is valid
    if ($request->bearerToken() !== base64_encode('Frenki Herlambang Prasetyo')) {
        return [
            'status' => 'error',
            'message' => 'Unauthorized',
        ];
    }

    return [
        'order_id' => $request->input('order_id'),
        'amount' => $request->input('amount'),
        'status' => 1,
    ];

});

Route::post('withdrawal', function (Request $request) {

    // check if bearer token is valid
    if ($request->bearerToken() !== base64_encode('Frenki Herlambang Prasetyo')) {
        return [
            'status' => 'error',
            'message' => 'Unauthorized',
        ];
    }

    return [
        'order_id' => $request->input('order_id'),
        'amount' => $request->input('amount'),
        'status' => 1,
    ];

});
