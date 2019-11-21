<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropVoluntariosColumnFromNucleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nucleos', function (Blueprint $table) {
            $table->dropColumn('Voluntarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nucleos', function (Blueprint $table) {
            $table->string('Voluntarios')->nullable();
        });
    }
}
