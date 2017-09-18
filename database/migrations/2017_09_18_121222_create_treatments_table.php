<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('type');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('patronymic')->nullable();
            $table->string('gender')->nullable();
            $table->string('address');
            $table->string('email');
            $table->string('post_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('thematic');
            $table->text('message');
            $table->string('file_url')->nullable();
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
        Schema::dropIfExists('treatments');
    }
}
