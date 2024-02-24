<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('town')->nullable();
            $table->string('department')->nullable();
            $table->float('total_price')->nullable();
            $table->text('commentary')->nullable();
            $table->string('town_ref')->nullable();
            $table->string('area')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();


            $table->foreign('status_id')->references('id')->on('order_status');
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
        Schema::dropIfExists('orders');
    }
};
