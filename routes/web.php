<?php

/*
* This file is part of the Dotenv UniPay package.
*
* (c) Tiago Perrelli <tiagoyg@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

Route::middleware('web')
    // ->get(config('routes.gateway.name', 'gateways'))
    // ->php arasdauses('DotEnv\UniPay\Controllers\GateweyController@index');
    ->resource(config('unipay.routes.gateway', 'gateways'), 
        'DotEnv\UniPay\Controllers\GatewayController'
    )->except('show');

Route::middleware('web')
    ->resource(config('unipay.routes.seller', 'sellers'), 
        'DotEnv\UniPay\Controllers\MerchantController'
    )->except('show');
