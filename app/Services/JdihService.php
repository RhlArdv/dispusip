<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class JdihService
{
    protected string $apiUrl = 'https://jdih.padang.go.id/integrasiJDIH/integrasipadang';

    /**
     * Keyword untuk filter data terkait Dispusip
     */
    protected array $keywords = [
        'perpustakaan',
        'kearsipan',
        'arsip',
        'pustaka',
        'dispusip',
        'literasi',
    ];

    /**
     * Ambil semua data dari API JDIH, cache 6 jam
     */
    public function fetchAll(): array
    {
        return Cache::remember('jdih_all_data', 60 * 60 * 6, function () {
            $response = Http::timeout(30)->get($this->apiUrl);

            if ($response->failed()) {
                return [];
            }

            return $response->json() ?? [];
        });
    }

    /**
     * Filter data yang relevan dengan Dispusip
     */
    public function getDispusipData(): array
    {
        $all = $this->fetchAll();

        return array_values(array_filter($all, function ($item) {
            foreach ($this->keywords as $keyword) {
                if (
                    str_contains(strtolower($item['judul'] ?? ''), $keyword) ||
                    str_contains(strtolower($item['subjek'] ?? ''), $keyword) ||
                    str_contains(strtolower($item['teuBadan'] ?? ''), $keyword) ||
                    str_contains(strtolower($item['bidangHukum'] ?? ''), $keyword) ||
                    str_contains(strtolower($item['abstrak'] ?? ''), $keyword)
                ) {
                    return true;
                }
            }
            return false;
        }));
    }

    /**
     * Filter + search tambahan dari user
     */
    public function search(?string $query = '', ?string $jenis = '', ?string $tahun = ''): array
    {
        $data = $this->getDispusipData();

        if ($query) {
            $q = strtolower($query);
            $data = array_filter($data, fn($item) =>
                str_contains(strtolower($item['judul'] ?? ''), $q) ||
                str_contains(strtolower($item['subjek'] ?? ''), $q)
            );
        }

        if ($jenis) {
            $data = array_filter($data, fn($item) =>
                strtolower($item['jenis'] ?? '') === strtolower($jenis)
            );
        }

        if ($tahun) {
            $data = array_filter($data, fn($item) =>
                ($item['tahun_pengundangan'] ?? '') === $tahun
            );
        }

        return array_values($data);
    }

    /**
     * Ambil daftar jenis peraturan yang tersedia
     */
    public function getJenisOptions(): array
    {
        $data = $this->getDispusipData();
        $jenis = array_unique(array_column($data, 'jenis'));
        sort($jenis);
        return array_filter($jenis);
    }

    /**
     * Ambil daftar tahun yang tersedia
     */
    public function getTahunOptions(): array
    {
        $data = $this->getDispusipData();
        $tahun = array_unique(array_column($data, 'tahun_pengundangan'));
        rsort($tahun);
        return array_filter($tahun);
    }

    /**
     * Hapus cache manual (untuk refresh data)
     */
    public function clearCache(): void
    {
        Cache::forget('jdih_all_data');
    }
}