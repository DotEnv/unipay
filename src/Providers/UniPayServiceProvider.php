<?php

/*
* This file is part of the Dotenv UniPay package.
*
* (c) Tiago Perrelli <tiagoyg@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace DotEnv\UniPay\Providers;

use Illuminate\Support\ServiceProvider;

use GuzzleHttp\Client;

use DotEnv\UniPay\Repositories\GatewayRepository;
use DotEnv\UniPay\Contracts\GatewayRepository as GatewayRepositoryContract;

use DotEnv\UniPay\Repositories\MerchantRepository;
use DotEnv\UniPay\Contracts\MerchantRepository as MerchantRepositoryContract;

use DotEnv\UniPay\Repositories\ZoopWSRepository;
use DotEnv\UniPay\Contracts\GatewayWSRepository;

use DotEnv\UniPay\UniPay;

class UniPayServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Load routes
         */
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        /**
         * Load views
         */
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'unipay');

        /**
         * Publishes database migrations
         */
        $this->publishes([__DIR__ . '/../../database/migrations/' => base_path('database/migrations')], 'migrations');

        /**
         * Publishes configuration file
         */
        $this->publishes([__DIR__ . '/../../config/unipay.php' => config_path('unipay.php')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('unipay', function($app) {

            return new UniPay;
        });

        /**
         * Bind repositories
         */
        $this->app->bind(
            GatewayRepositoryContract::class,
            GatewayRepository::class
        );

        $this->app->bind(
            MerchantRepositoryContract::class,
            MerchantRepository::class
        );

        $this->app->bind(GatewayWSRepository::class, function($app) {
            
            $guzzle = new Client([
                'base_uri'       => 'https://api.zoop.ws/v1/marketplaces/2f9b466125ca4af3b33cb64e282caead/',
            ]);

            return new ZoopWSRepository($guzzle, 'zpk_test_vBt3doR7ilwFaoyHhzrAfhbg');
        });
    }
}