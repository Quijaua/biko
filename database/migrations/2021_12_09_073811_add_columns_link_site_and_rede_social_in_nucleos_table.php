<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsLinkSiteAndRedeSocialInNucleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nucleos', function (Blueprint $table) {
          $table->string('LinkSite')->after('Facebook')->nullable();
          $table->string('RedeSocial')->after('LinkSite')->nullable();
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
          $table->dropColumn(['LinkSite', 'RedeSocial']);
        });
    }
}
