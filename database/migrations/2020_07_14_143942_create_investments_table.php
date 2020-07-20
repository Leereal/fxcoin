<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount');
            $table->string('description');
            $table->string('transaction_code')->unique();
            $table->decimal('expected_profit');
            $table->decimal('balance');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('user_id');
            $table->date('due_date');
            $table->timestamps();
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('currency_id');
            $table->text('comments');
            $table->string('pop');
            $table->integer('status')->default(1);
            $table->ipAddress('ipAddress');
            $table->softDeletes();          
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investments');
    }
}
