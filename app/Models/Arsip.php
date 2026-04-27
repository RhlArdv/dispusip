<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $fillable = [
        'tingkat_perkembangan',
        'bentuk',
        'keterangan',
        'indeks',
        'deskripsi',
        'tahun',
        'jumlah',
        'rak',
        'roll_o_pack',
        'boks',
        'bungkus',
        'buku',
        'sampul',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    // Accessors untuk display fields
    public function getTingkatPerkembanganDisplayAttribute()
    {
        return $this->tingkat_perkembangan ?? '-';
    }

    public function getBentukDisplayAttribute()
    {
        return $this->bentuk ?? '-';
    }

    public function getKeteranganDisplayAttribute()
    {
        return $this->keterangan ?? '-';
    }

    public function getLokasiDisplayAttribute()
    {
        $lokasi = collect([
            $this->rak ? "Rak: {$this->rak}" : null,
            $this->roll_o_pack ? "Roll: {$this->roll_o_pack}" : null,
            $this->boks ? "Boks: {$this->boks}" : null,
            $this->bungkus ? "Bungkus: {$this->bungkus}" : null,
            $this->buku ? "Buku: {$this->buku}" : null,
            $this->sampul ? "Sampul: {$this->sampul}" : null,
        ])->filter()->implode(' / ');

        return $lokasi ?: '-';
    }
}
