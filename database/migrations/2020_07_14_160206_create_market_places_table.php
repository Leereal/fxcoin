<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->decimal('amount');
            $table->decimal('balance');
            $table->string('reason');
            $table->string('transaction_code')->unique();   
            $table->unsignedBigInteger('payment_detail_id');
            $table->unsignedBigInteger('investment_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment')->nullable();            
            $table->integer('status')->default(2);
            $table->ipAddress('ipAddress');
            $table->softDeletes();   

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');            
            $table->foreign('payment_detail_id')->references('id')->on('payment_details')->onDelete('cascade');
            $table->foreign('investment_id')->references('id')->on('investments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_places');
    }
}
