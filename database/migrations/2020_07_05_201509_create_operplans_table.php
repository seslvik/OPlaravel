<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operplans', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');

            $table->string('zavod', 20);
            $table->string('objekt');
            $table->text('opisanie');
            $table->string('file')->nullable();
            $table->float('pos_x', 4,3);
            $table->float('pos_y', 4,3);

            $table->timestamps();
            $table->softDeletes();
            //индекс
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
                //->onDelete('cascade'); если это написать то при удалении пользователя удалятся все его записи в других таблицах
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operplans');
    }
}
