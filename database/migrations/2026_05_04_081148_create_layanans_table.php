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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url');
            $table->enum('link_type', ['internal', 'external'])->default('external');
            $table->enum('section', ['utama', 'sekunder'])->default('sekunder');
            $table->string('badge_label')->nullable();   // Label badge (contoh: "Katalog")
            $table->string('bg_image')->nullable();      // Gambar background (khusus bento card tertentu)
            $table->text('icon_svg')->nullable();        // Kode SVG untuk icon
            $table->string('style_variant')->nullable(); // Nama varian style (mis: 'dark', 'gold', 'light', 'image')
            $table->integer('order_number')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
