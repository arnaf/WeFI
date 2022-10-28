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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kelas_id');
            // $table->foreignId('bimbel_id');
            $table->text('foto')->nullable();
            $table->string('invoice');
            $table->string('status')->default('belum terbayar');
            $table->string('metode');
            $table->decimal('jml_byr', 14, 2)->nullable(); //jadi nanti buat fungsi jumlah dibayar - harga bimbel(sebagai tagihan), nah kolom tagihan dari situ ambilnya
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('kelas_id')->references('id')->on('users')->onDelete('restrict');
            // $table->foreign('bimbel_id')->references('id')->on('bimbels')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihans');
    }
};
