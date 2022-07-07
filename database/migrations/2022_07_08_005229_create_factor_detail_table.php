<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factor_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->integer('factor');
            $table->integer('product');
            $table->integer('number');
            $table->string('price', 15);
            $table->string('comment', 500);
            $table->smallInteger('status');
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
        Schema::dropIfExists('factor_detail');
    }
}
