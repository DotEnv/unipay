<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('unipay.databases.merchant', 'merchants'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->text('fields');
            $table->string('type', 30);
            $table->string('reference', 100)->nullable();
            $table->integer('gateway_id')->unsigned();
            $table->foreign('gateway_id')->references('id')->on(config('unipay.databases.gateway', 'gateways'));
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
        Schema::dropIfExists(config('unipay.databases.merchant', 'merchants'));
    }
}
