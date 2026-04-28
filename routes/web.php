<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicBeritaController;
use App\Models\Berita;
use Illuminate\Support\Facades\Route;

Route::get('/', function (\Illuminate\Http\Request $request) {
    // Record visitor
    $ip = $request->ip();
    $today = \Carbon\Carbon::today();
    
    $visitedToday = \App\Models\Visitor::where('ip_address', $ip)
        ->whereDate('created_at', $today)
        ->first();
        
    if (!$visitedToday) {
        \App\Models\Visitor::create(['ip_address' => $ip]);
    }

    $beritaTerbaru = Berita::latest()->take(3)->get();
    $kegiatanTerbaru = \App\Models\Kegiatan::latest()->take(5)->get();
    $faqs = \App\Models\Faq::where('is_active', true)->take(5)->get();
    $settings = \App\Models\Setting::all()->keyBy('key');
    
    // Calculate visitor stats
    $visitorToday = \App\Models\Visitor::whereDate('created_at', $today)->count();
    $visitorMonth = \App\Models\Visitor::whereMonth('created_at', \Carbon\Carbon::now()->month)
                                       ->whereYear('created_at', \Carbon\Carbon::now()->year)->count();
    $visitorTotal = \App\Models\Visitor::count();
    
    // For chart (last 7 days)
    $last7Days = \App\Models\Visitor::where('created_at', '>=', \Carbon\Carbon::now()->subDays(6)->startOfDay())->get();
    
    $chartDates = [];
    $chartCounts = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
        $chartDates[] = \Carbon\Carbon::parse($date)->format('d M');
        
        $count = $last7Days->filter(function($visitor) use ($date) {
            return $visitor->created_at->format('Y-m-d') === $date;
        })->count();
        
        $chartCounts[] = $count;
    }

    return view('welcome', compact(
        'beritaTerbaru', 'kegiatanTerbaru', 'faqs', 'settings',
        'visitorToday', 'visitorMonth', 'visitorTotal', 
        'chartDates', 'chartCounts'
    ));
});

// Public routes
Route::get('/e-perpus', [\App\Http\Controllers\EPerpusController::class, 'index'])->name('eperpus.index');
Route::get('/testimoni', [\App\Http\Controllers\PublicTestimoniController::class, 'index'])->name('public.testimoni.index');

// Aktivitas (Berita, Testimoni, Agenda)
Route::get('/aktivitas', [\App\Http\Controllers\PublicAktivitasController::class, 'index'])->name('public.aktivitas.index');
Route::get('/aktivitas/agenda/{slug}', [\App\Http\Controllers\PublicAktivitasController::class, 'showAgenda'])->name('public.agenda.show');
Route::get('/berita', [\App\Http\Controllers\PublicBeritaController::class, 'index'])->name('public.berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\PublicBeritaController::class, 'show'])->name('public.berita.show');

Route::get('/kegiatan', [\App\Http\Controllers\PublicKegiatanController::class, 'index'])->name('public.kegiatan.index');
Route::get('/kegiatan/{slug}', [\App\Http\Controllers\PublicKegiatanController::class, 'show'])->name('public.kegiatan.show');

Route::get('/arsip', [\App\Http\Controllers\PublicArsipController::class, 'index'])->name('public.arsip.index');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('menu')->group(function () {
        // User Management
        Route::resource('users', UserController::class);

        // Role Management
        Route::resource('roles', RoleController::class);
        Route::get('roles/{role}/edit-permissions', [RoleController::class, 'edit'])
            ->name('roles.edit-permissions');
        Route::put('roles/{role}/permissions', [RoleController::class, 'update'])
            ->name('roles.update-permissions');
        Route::post('roles/{role}/reset', [RoleController::class, 'reset'])
            ->name('roles.reset');

        // Arsip Management
        Route::resource('arsip', ArsipController::class)
            ->middleware(['permission:view_arsip']);

        // Berita Management
        Route::resource('berita', BeritaController::class)
            ->middleware(['permission:view_berita']);

        // Koleksi Management
        Route::resource('koleksi', KoleksiController::class)
            ->middleware(['permission:view_koleksi']);

        // Kegiatan Management
        Route::resource('kegiatan', KegiatanController::class)
            ->middleware(['permission:view_kegiatan']);

        // FAQ Management
        Route::resource('faq', \App\Http\Controllers\FaqController::class);

        // Testimoni Management
        Route::resource('testimoni', \App\Http\Controllers\TestimoniController::class);

        // Agenda Management
        Route::resource('agenda', \App\Http\Controllers\AgendaController::class);

        // Infografis Management (E-Perpus)
        Route::resource('infografis', \App\Http\Controllers\InfografisController::class);

        // Tickets Management
        Route::get('tickets', [\App\Http\Controllers\TicketController::class, 'index'])
            ->name('tickets.index');
        Route::put('tickets/{id}/status', [\App\Http\Controllers\TicketController::class, 'updateStatus'])
            ->name('tickets.update-status');
        Route::delete('tickets/{id}', [\App\Http\Controllers\TicketController::class, 'destroy'])
            ->name('tickets.destroy');

        // Settings Management
        Route::get('settings', [\App\Http\Controllers\SettingController::class, 'index'])
            ->name('settings.index');
        Route::put('settings', [\App\Http\Controllers\SettingController::class, 'update'])
            ->name('settings.update');
    });
});

// Public Ticket Submit
Route::post('/tickets/submit', [\App\Http\Controllers\TicketController::class, 'publicSubmit'])->name('tickets.submit');

require __DIR__ . '/auth.php';
