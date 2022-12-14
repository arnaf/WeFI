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
        Schema::create('kelass', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id');
            $table->text('gambar');
            $table->string('judulkelas');
            $table->string('pengajar');
            $table->text('deskripsi');
            $table->string('kode')->unique();
            $table->decimal('harga', 14, 2);
            // $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelass');
    }
};
