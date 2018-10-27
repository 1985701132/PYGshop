<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->char('email',60)->comment('邮箱');
            $table->string('face')->comment('头像');
            $table->longText('address')->comment('地址');
            $table->enum('gender',['man','woman','secret'])->default('man')->comment('性别');
            $table->enum('is_use',['yes','no '])->default('yes')->comment('是否启用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('face');
            $table->dropColumn('address');
            $table->dropColumn('gender');           
            $table->dropColumn('is_use');           
        });
    }
}
