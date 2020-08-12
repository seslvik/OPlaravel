<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolygonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polygons', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');

            $table->string('zavod', 20);
            $table->text('opisanie');
            $table->string('color');

            $table->float('pos_x_1', 4,3)->nullable();
            $table->float('pos_y_1', 4,3)->nullable();
            $table->float('pos_x_2', 4,3)->nullable();
            $table->float('pos_y_2', 4,3)->nullable();
            $table->float('pos_x_3', 4,3)->nullable();
            $table->float('pos_y_3', 4,3)->nullable();
            $table->float('pos_x_4', 4,3)->nullable();
            $table->float('pos_y_4', 4,3)->nullable();
            $table->float('pos_x_5', 4,3)->nullable();
            $table->float('pos_y_5', 4,3)->nullable();
            $table->float('pos_x_6', 4,3)->nullable();
            $table->float('pos_y_6', 4,3)->nullable();
            $table->float('pos_x_7', 4,3)->nullable();
            $table->float('pos_y_7', 4,3)->nullable();
            $table->float('pos_x_8', 4,3)->nullable();
            $table->float('pos_y_8', 4,3)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
               // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polygons');
    }
}
