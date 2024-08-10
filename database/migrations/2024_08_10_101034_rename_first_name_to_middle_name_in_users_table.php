<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFirstNameToMiddleNameInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('middle_name')->nullable()->after('first_name');
        });

        DB::table('users')
            ->update(['middle_name' => DB::raw('first_name')]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
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
            $table->string('first_name')->after('last_name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('middle_name');
        });
    }
}
