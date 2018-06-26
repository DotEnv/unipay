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
        Schema::create(config('unipay.routes.merchant.name', 'merchants'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 15);
            $table->date('birth');
            $table->string('cpf', 15);
            $table->string('city', 50);
            $table->string('postal', 9);
            $table->string('neighborhood', 50);
            $table->string('address', 100);
            $table->string('number', 30);
            $table->string('complement', 50);
            $table->string('reference', 50);
            $table->string('company', 50)->nullable();
            $table->string('social_name', 50)->nullable();
            $table->string('cnpj', 18)->nullable();
            $table->string('company_phone', 15)->nullable();
            $table->string('company_city', 50)->nullable();
            $table->string('company_postal', 9)->nullable();
            $table->string('company_neighborhood', 50)->nullable();
            $table->string('company_address', 100)->nullable();
            $table->string('company_number', 30)->nullable();
            $table->string('company_complement', 50)->nullable();
            $table->string('company_site', 150)->nullable();
            $table->integer('state_id')->unsigned()->nullable();
            $table->integer('company_state_id')->unsigned()->nullable();
            $table->date('opened_at')->nullable();
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
        Schema::dropIfExists(config('unipay.routes.merchant.name', 'merchants'));
    }
}
