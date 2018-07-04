<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('unipay.databases.payment', 'payments'), function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->string('currency', 3);
            $table->string('payment_type', 20);
            $table->string('transaction_id', 100);
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on(config('unipay.databases.seller', 'sellers'));
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
        Schema::dropIfExists(config('unipay.databases.payment', 'payments'));
    }
}
