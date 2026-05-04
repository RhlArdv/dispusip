<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;

class ArsipAPIController extends Controller
{
    /**
     * Display a listing of arsip.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            // Query builder
            $query = Arsip::query();

            // Search by deskripsi or indeks
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('deskripsi', 'LIKE', "%{$search}%")
                      ->orWhere('indeks', 'LIKE', "%{$search}%");
                });
            }

            // Filter by tahun
            if ($request->has('tahun')) {
                $query->where('tahun', $request->tahun);
            }

            // Filter by bentuk
            if ($request->has('bentuk')) {
                $query->where('bentuk', $request->bentuk);
            }

            // Filter by tingkat_perkembangan
            if ($request->has('tingkat_perkembangan')) {
                $query->where('tingkat_perkembangan', $request->tingkat_perkembangan);
            }

            // Filter by keterangan
            if ($request->has('keterangan')) {
                $query->where('keterangan', 'LIKE', "%{$request->keterangan}%");
            }

            // Order by
            $orderBy = $request->get('order_by', 'created_at');
            $orderDir = $request->get('order_dir', 'desc');

            // Validate order_by to prevent SQL injection
            $allowedFields = ['id', 'indeks', 'deskripsi', 'tahun', 'created_at'];
            if (in_array($orderBy, $allowedFields)) {
                $query->orderBy($orderBy, $orderDir);
            }

            // Pagination
            $perPage = $request->get('per_page', 20);
            $page = $request->get('page', 1);

            // Validate per_page
            if ($perPage > 100) {
                $perPage = 100;
            } elseif ($perPage < 1) {
                $perPage = 20;
            }

            $result = $query->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'status' => 'success',
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
                'per_page' => $result->perPage(),
                'total' => $result->total(),
                'data' => $result->items(),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data arsip',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified arsip.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $arsip = Arsip::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $arsip,
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Arsip tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data arsip',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
