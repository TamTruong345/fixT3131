<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id');
            $table->string('project_name');
            $table->string('project_customer_id')->nullable()->default(null);
            $table->string('project_customer_name')->nullable()->default(null);
            $table->string('project_member_name')->nullable()->default(null);
            $table->string('project_status', 45)->nullable()->default(null);
            $table->double('project_money')->nullable()->default(null);
            $table->text('project_last_memo')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
