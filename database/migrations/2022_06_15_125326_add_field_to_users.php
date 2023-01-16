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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
            $table->string('password')->nullable()->change();
            $table->string('phone', 50)->after('password')->nullable();
            $table->string('age')->after('phone')->nullable();
            $table->integer('sex')->after('age')->comment('1.male, 2.female, 3.other');
            $table->integer('role')->after('sex')->comment('1.super admin, 2.sub admin, 3.user');
            $table->text('image')->after('role')->nullable();
            $table->string('message')->after('image')->nullable();
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
            //
        });
    }
};
