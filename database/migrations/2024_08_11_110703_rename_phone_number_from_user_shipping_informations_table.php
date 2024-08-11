<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePhoneNumberFromUserShippingInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_shipping_informations', function (Blueprint $table) {
            $table->renameColumn('phone_number', 'phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_shipping_informations', function (Blueprint $table) {
            $table->renameColumn('phone', 'phone_number');
        });
    }
}
