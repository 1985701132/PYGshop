<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPathToPrivilege extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('privileges', function (Blueprint $table) {
            $table->string('path',10)->default('-')->comment('所有上级分类ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('privileges', function (Blueprint $table) {
            $table->dropColumn('path');            
        });
    }
}
