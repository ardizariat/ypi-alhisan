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
        Schema::create('peserta_rapat_yayasan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rapat_yayasan_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('rapat_yayasan_id')->references('id')
                ->on('rapat_yayasan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->setNullDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_rapat_yayasan');
    }
};
