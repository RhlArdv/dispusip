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
        Schema::create('kategori_buku', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('slug', 100)->unique();
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed data kategori buku
        DB::table('kategori_buku')->insert([
            [
                'nama' => 'Fiksi',
                'slug' => 'fiksi',
                'deskripsi' => 'Buku cerita fiksi, novel, roman',
                'urutan' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Non-Fiksi',
                'slug' => 'non-fiksi',
                'deskripsi' => 'Buku pengetahuan umum, sejarah, biografi',
                'urutan' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Anak',
                'slug' => 'anak',
                'deskripsi' => 'Buku anak dan cerita bergambar',
                'urutan' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Remaja',
                'slug' => 'remaja',
                'deskripsi' => 'Buku untuk remaja dan young adult',
                'urutan' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Referensi',
                'slug' => 'referensi',
                'deskripsi' => 'Buku referensi, ensiklopedia, kamus',
                'urutan' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Akademik',
                'slug' => 'akademik',
                'deskripsi' => 'Buku teks dan buku akademik',
                'urutan' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_buku');
    }
};
