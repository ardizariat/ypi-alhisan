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
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('user_id');
            $table->text('judul');
            $table->longText('konten');
            $table->string('thumbnail')->nullable();
            $table->integer('dilihat')->nullable()->default(0);
            $table->dateTime('dipublikasi')->nullable();
            $table->string('status')->nullable()->default('draft');
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')
                ->on('kategori')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('user_id')->references('id')
                ->on('users')
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
        Schema::dropIfExists('artikel');
    }
};
