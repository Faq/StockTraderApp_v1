<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('portfolio', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->string('company')->default(null);
            $table->string('symbol');
            $table->bigInteger('quantity');
            $table->string('buy_price');
            $table->string('total_price');
            $table->string('sell_price')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio');
    }
}
