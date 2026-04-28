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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text')->default('text'); // text, number, boolean, json
            $table->string('group')->nullable()->default('general'); // general, maps, contact, dll
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            [
                'key' => 'maps_embed_link',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!2d-0.930902!3d107.6347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e56f70a67f6c94d%3A0x36ef942943a1d945!2sPerpustakaan%20Daerah%20Kota%20Padang!5e0!3m2!1sid!2sid!4v1685857820405!5m2!1sid!2sid',
                'type' => 'text',
                'group' => 'maps',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@dispusip.padang.go.id',
                'type' => 'text',
                'group' => 'contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_phone',
                'value' => '+62 755 123456',
                'type' => 'text',
                'group' => 'contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_address',
                'value' => 'Jl. Kampus UNP, Lubuk Minturun, Kec. Lamposi, Padang',
                'type' => 'text',
                'group' => 'contact',
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
        Schema::dropIfExists('settings');
    }
};
