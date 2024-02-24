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
        Schema::create('sizetbl', function (Blueprint $table) {
            $table->integer('table_id');
            $table->string('title');
            $table->string('size_name');
            $table->integer('breast');
            $table->integer('sleeve');
            $table->integer('length');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizetbl');
    }
};
