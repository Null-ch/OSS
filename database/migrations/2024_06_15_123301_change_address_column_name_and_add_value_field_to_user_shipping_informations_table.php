<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAddressColumnNameAndAddValueFieldToUserShippingInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_shipping_informations', function (Blueprint $table) {
            $table->renameColumn('addres', 'type');
            $table->text('value')->after('user_id');
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
            $table->renameColumn('type', 'addres');
            $table->dropColumn('value');
        });
    }
}
