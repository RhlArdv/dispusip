<?php

namespace App\Http\Controllers;

use App\Services\JdihService;
use Illuminate\Http\Request;

class JdihController extends Controller
{
    public function __construct(protected JdihService $jdih) {}

    public function index(Request $request)
    {
        $query  = $request->get('q', '');
        $jenis  = $request->get('jenis', '');
        $tahun  = $request->get('tahun', '');

        $peraturan    = $this->jdih->search($query, $jenis, $tahun);
        $jenisOptions = $this->jdih->getJenisOptions();
        $tahunOptions = $this->jdih->getTahunOptions();
        $total        = count($peraturan);

        return view('jdih.index', compact(
            'peraturan', 'jenisOptions', 'tahunOptions',
            'total', 'query', 'jenis', 'tahun'
        ));
    }

    /**
     * Endpoint untuk refresh cache (bisa dipanggil via cron atau manual)
     */
    public function refresh()
    {
        $this->jdih->clearCache();
        return redirect()->route('jdih.index')->with('success', 'Data JDIH berhasil diperbarui.');
    }
}