<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_options', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto increment
            $table->enum('kategori', ['struktural', 'panitia', 'satker']);
            $table->string('nama_opsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_options');
    }
};
