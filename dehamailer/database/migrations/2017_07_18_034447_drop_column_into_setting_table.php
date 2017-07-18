<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnIntoSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting', function($table) {
            $table->dropColumn('setting_username');
            $table->dropColumn('setting_mail_send');
            $table->dropColumn('setting_password');
            $table->dropColumn('setting_reply_to');
            $table->dropColumn('setting_time_interval');
            $table->dropColumn('setting_from_name');
            $table->dropColumn('mail_sent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
