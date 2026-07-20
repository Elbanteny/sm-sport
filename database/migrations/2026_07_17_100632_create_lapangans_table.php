<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapangans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lapangan');
        $table->enum('jenis_lapangan', ['futsal', 'badminton', 'basket']); 
        $table->string('kategori'); 
        $table->enum('tipe', ['indoor', 'outdoor']); 
        $table->string('image_url');
        $table->integer('tarif_per_jam');
        $table->decimal('rating', 2, 1)->default(5.0);
        $table->integer('reviews')->default(0);
        $table->string('badge')->nullable();
        $table->text('deskripsi');
        $table->json('facilities');
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapangans');
    }
};