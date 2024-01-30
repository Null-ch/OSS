<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHexCodeToColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('colors')) {
            Schema::table('colors', function (Blueprint $table) {
                $table->string('hex_code')->after('title');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->dropColumn('hex_code');
        });
    }
}
