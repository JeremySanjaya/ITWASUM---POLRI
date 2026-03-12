<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('presensis', function (Blueprint $table) {
        $table->id();
        
        // Data dari Halaman 1
        $table->string('nama_lengkap');
        $table->string('pangkat_nrp');
        $table->string('jabatan_struktural');
        $table->string('jabatan_panitia');
        $table->string('satker');
        $table->string('pelaksanaan');

        // Data dari Halaman 2 (Tanda Tangan)
        // Kita pakai text karena tanda tangan digital biasanya dikirim sebagai string Base64 yang panjang
        $table->text('tanda_tangan')->nullable();

        $table->timestamps();
    });
}};
