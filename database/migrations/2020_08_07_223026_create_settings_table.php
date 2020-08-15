<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->integer('market_place_status');
            $table->decimal('min_deposit');
            $table->decimal('max_deposit');
            $table->decimal('min_withdrawal');
            $table->decimal('max_withdrawal');
            $table->decimal('max_transactions');
            $table->integer('number_of_users');
            $table->decimal('total_deposits');
            $table->decimal('total_withdrawals');
            $table->decimal('total_online');
            $table->string('trade_type');
            $table->string('bitcoin');
            $table->unsignedBigInteger('currency_id');
            $table->integer('status')->default(1);            
            $table->timestamps();
            $table->softDeletes(); 

            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
