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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('slug', 255)->unique();
            $table->string('penulis', 500)->nullable();
            $table->string('penerbit', 255)->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('isbn', 50)->nullable();
            $table->text('uraian')->nullable();
            $table->text('abstrak')->nullable();
            $table->string('sumber', 500)->nullable();
            $table->string('sampul', 255)->nullable();
            $table->string('file_pdf', 255)->nullable();
            $table->unsignedBigInteger('kategori_buku_id')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            // Indexes
            $table->index('penulis', 'idx_penulis');
            $table->index('penerbit', 'idx_penerbit');
            $table->index('tahun_terbit', 'idx_tahun');
            $table->index('isbn', 'idx_isbn');
            $table->index('slug', 'idx_slug');
            $table->index('kategori_buku_id', 'idx_kategori');

            // Foreign key
            $table->foreign('kategori_buku_id')
                  ->references('id')
                  ->on('kategori_buku')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
