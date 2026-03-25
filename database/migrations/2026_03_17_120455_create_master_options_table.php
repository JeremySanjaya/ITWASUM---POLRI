<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('master_options', function (Blueprint $table) {
        $table->id();
        $table->enum('kategori', ['struktural', 'panitia', 'satker']);
        $table->string('nama_opsi');
        $table->timestamps();
    });
}
function down(): void
    {
        Schema::dropIfExists('master_options');
    }
};
