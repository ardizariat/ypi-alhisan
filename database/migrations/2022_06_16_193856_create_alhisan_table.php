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
        Schema::create('alhisan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('ig')->nullable();
            $table->string('fb')->nullable();
            $table->string('youtube')->nullable();
            $table->string('telegram')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_telpon')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->longText('tujuan')->nullable();
            $table->longText('alamat')->nullable();
            $table->longText('sejarah')->nullable();
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
        Schema::dropIfExists('alhisan');
    }
};
