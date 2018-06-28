<?php

/*
* This file is part of the Dotenv UniPay package.
*
* (c) Tiago Perrelli <tiagoyg@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('unipay.databases.gateway', 'gateways'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->text('description');
            $table->string('username', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('account_id', 70)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('unipay.databases.gateway', 'gateways'));
    }
}
