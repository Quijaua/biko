<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('nucleo_id');
            $table->string('name', 255);
            $table->integer('status');

            $table->foreign('user_id')
                  ->references('id')->on('users');

            $table->foreign('nucleo_id')
                  ->references('id')->on('nucleos');

            $table->softDeletes();
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
      Schema::dropForeign(['materials_user_id_foreign', 'materials_nucleo_id_foreign']);
      Schema::dropIfExists('materials');
    }
}
