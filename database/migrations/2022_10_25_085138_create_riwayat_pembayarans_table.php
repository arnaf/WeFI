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
        Schema::create('riwayat_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id');
            $table->foreignId('user_id');
            $table->foreignId('bimbel_id');
            $table->decimal('debit', 14, 2);
            $table->timestamps();

            $table->foreign('tagihan_id')->references('id')->on('tagihans')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('bimbel_id')->references('id')->on('bimbels')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pembayarans');
    }
};
