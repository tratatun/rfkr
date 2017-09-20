<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGovResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gov_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('title');
            $table->string('url');
            $table->integer('user_id');
            $table->integer('updated_user_id');
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
        Schema::dropIfExists('gov_resources');
    }
}
