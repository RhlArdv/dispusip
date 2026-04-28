<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    // Public: Submit form dari landing page
    public function publicSubmit(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'pesan' => 'required|string',
        ], [
            'pesan.required' => 'Pesan wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $validated['status'] = 'pending';

        Ticket::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan segera merespons.');
    }

    // Admin: Index
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('tickets.index');
    }

    private function dataTable()
    {
        $query = Ticket::orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('nama', function ($ticket) {
                return '<div class="font-semibold text-gray-800">' . e($ticket->nama ?: 'Anonim') . '</div>';
            })
            ->addColumn('email', function ($ticket) {
                return '<div class="text-sm text-gray-600">' . e($ticket->email ?: '-') . '</div>';
            })
            ->addColumn('excerpt', function ($ticket) {
                $excerpt = strip_tags($ticket->pesan);
                $excerpt = strlen($excerpt) > 100 ? substr($excerpt, 0, 100) . '...' : $excerpt;
                return '<div class="text-sm text-gray-600">' . e($excerpt) . '</div>';
            })
            ->addColumn('status', function ($ticket) {
                return $ticket->status_badge;
            })
            ->addColumn('tanggal', function ($ticket) {
                return '<div class="text-xs text-gray-600">' . $ticket->created_at->format('d M Y') . '</div>';
            })
            ->addColumn('aksi', function ($ticket) {
                $currentUser = Auth::user();
                $btn = '';

                if ($currentUser->hasPermission('edit_tickets')) {
                    $btn .= '<button onclick="updateStatus(' . $ticket->id . ', \'' . addslashes($ticket->nama ?: 'Anonim') . '\')"
                                class="px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-50
                                       hover:bg-amber-100 rounded-lg transition-colors mr-1">
                                Status
                             </button>';
                }

                if ($currentUser->hasPermission('delete_tickets')) {
                    $btn .= '<button onclick="hapusTicket(' . $ticket->id . ', \'' . addslashes($ticket->nama ?: 'Anonim') . '\')"
                                class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50
                                       hover:bg-red-100 rounded-lg transition-colors">
                                Hapus
                             </button>';
                }

                return $btn ?: '<span class="text-xs text-gray-400">—</span>';
            })
            ->rawColumns(['nama', 'email', 'excerpt', 'status', 'tanggal', 'aksi'])
            ->make(true);
    }

    // Admin: Update status
    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,dibaca,diselesaikan',
        ]);

        $ticket->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui.'
        ]);
    }

    // Admin: Destroy
    public function destroy($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $nama = $ticket->nama ?: 'Anonim';
            $ticket->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tiket dari "' . $nama . '" berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus tiket.'
            ], 500);
        }
    }
}
