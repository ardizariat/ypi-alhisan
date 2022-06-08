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
        Schema::create('struktur_organisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengurus_yayasan_id');
            $table->unsignedBigInteger('bagian_id');
            $table->string('status')->default('aktif');
            $table->timestamps();

            $table->foreign('pengurus_yayasan_id')->references('id')
                ->on('pengurus_yayasan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('bagian_id')->references('id')
                ->on('bagian')
                ->cascadeOnDelete()
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
        Schema::dropIfExists('struktur_organisasi');
    }
};
