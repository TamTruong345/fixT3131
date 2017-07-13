<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mails', function (Blueprint $table) {
            $table->string('mail_customer_id')->nullable();
            $table->string('mail_customer_name')->nullable();
            $table->string('mail_customer_full_name')->nullable();
            $table->string('mail_customer_mail')->nullable();
            $table->string('mail_template_id')->nullable();
            $table->string('mail_template_subject')->nullable();
            $table->string('mail_template_content')->nullable();
            $table->string('mail_template_attachment')->nullable();
            $table->string('mail_template_mail_cc')->nullable();
            $table->string('mail_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mails', function (Blueprint $table) {
            //
        });
    }
}
