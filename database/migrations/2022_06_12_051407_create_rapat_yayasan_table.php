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
        Schema::create('rapat_yayasan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->dateTime('tanggal')->nullable();
            $table->longText('bahasan')->nullable();
            $table->longText('hasil')->nullable();
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
        Schema::dropIfExists('rapat_yayasan');
    }
};
