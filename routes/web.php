<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JdihController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\LinkAccessController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Berita;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
    $linkAccesses = \App\Models\LinkAccess::active()->ordered()->get();
    $settings = \App\Models\Setting::all()->keyBy('key');
    $kepalaDinas = \App\Models\Pejabat::active()->first(); // order_no=1 = Kepala Dinas

    // Ambil postingan Instagram (cache 12 jam)
    $instagramPosts = Cache::remember('ig_posts_dispussip', 43200, function () {
        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'x-rapidapi-host' => env('RAPID_API_HOST'),
                'x-rapidapi-key'  => env('RAPID_API_KEY'),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post('https://' . env('RAPID_API_HOST') . '/get_ig_user_posts.php', [
                'username_or_url' => 'https://www.instagram.com/dispusipkotapadang/',
                'pagination_token' => '',
                'amount' => 8, // Ambil 8 postingan
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Struktur response: { posts: [{node: ...}], pagination_token: ... }
                if (isset($data['posts']) && is_array($data['posts'])) {
                    $posts = [];

                    foreach ($data['posts'] as $post) {
                        if (isset($post['node'])) {
                            $node = $post['node'];

                            // Ambil image URL (candidates[1] lebih kecil untuk loading cepat)
                            $imageUrl = null;
                            if (isset($node['image_versions2']['candidates'][1]['url'])) {
                                $imageUrl = $node['image_versions2']['candidates'][1]['url'];
                            } elseif (isset($node['image_versions2']['candidates'][0]['url'])) {
                                $imageUrl = $node['image_versions2']['candidates'][0]['url'];
                            }

                            // Buat link ke Instagram
                            $shortcode = $node['shortcode'] ?? null;
                            $username = $node['user']['username'] ?? 'dispusipkotapadang';
                            $link = $shortcode ? "https://instagram.com/p/{$shortcode}" : "https://instagram.com/{$username}";

                            // Ambil likes count
                            $likes = $node['like_count'] ?? 0;

                            if ($imageUrl) {
                                $posts[] = [
                                    'image' => $imageUrl,
                                    'link' => $link,
                                    'likes' => $likes,
                                    'caption' => $node['caption']['text'] ?? '',
                                ];
                            }
                        }
                    }

                    // Return dalam format yang diharapkan oleh blade template
                    return [$posts];
                }
            }
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Instagram API Error: ' . $e->getMessage());

            // Return dummy data jika API gagal
            return [[
                ['image' => 'https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?w=400&h=400&fit=crop',
                 'link' => 'https://instagram.com/dispusipkotapadang',
                 'likes' => 124],
                ['image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400&h=400&fit=crop',
                 'link' => 'https://instagram.com/dispusipkotapadang',
                 'likes' => 89],
                ['image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=400&fit=crop',
                 'link' => 'https://instagram.com/dispusipkotapadang',
                 'likes' => 156],
                ['image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=400&fit=crop',
                 'link' => 'https://instagram.com/dispusipkotapadang',
                 'likes' => 201],
            ]];
        }

        return [];
    });

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

        $count = $last7Days->filter(function ($visitor) use ($date) {
            return $visitor->created_at->format('Y-m-d') === $date;
        })->count();

        $chartCounts[] = $count;
    }

    return view('welcome', compact(
        'beritaTerbaru',
        'kegiatanTerbaru',
        'faqs',
        'linkAccesses',
        'settings',
        'visitorToday',
        'visitorMonth',
        'visitorTotal',
        'instagramPosts',
        'chartDates',
        'chartCounts',
        'kepalaDinas'
    ));
});

// Public routes
Route::get('/e-perpus', [\App\Http\Controllers\EPerpusController::class, 'index'])->name('eperpus.index');
Route::get('/testimoni', [\App\Http\Controllers\PublicTestimoniController::class, 'index'])->name('public.testimoni.index');

Route::prefix('jdih')->name('jdih.')->group(function () {
    Route::get('/', [JdihController::class, 'index'])->name('index');
    Route::get('/refresh', [JdihController::class, 'refresh'])->name('refresh');
});

// Frontend
Route::get('/profil/{slug}', [ProfilController::class, 'show'])->name('profil.show');


// Aktivitas (Berita, Testimoni, Agenda)
Route::get('/aktivitas', [\App\Http\Controllers\PublicAktivitasController::class, 'index'])->name('public.aktivitas.index');
Route::get('/aktivitas/agenda/{slug}', [\App\Http\Controllers\PublicAktivitasController::class, 'showAgenda'])->name('public.agenda.show');
Route::get('/berita', [\App\Http\Controllers\PublicBeritaController::class, 'index'])->name('public.berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\PublicBeritaController::class, 'show'])->name('public.berita.show');

Route::get('/kegiatan', [\App\Http\Controllers\PublicKegiatanController::class, 'index'])->name('public.kegiatan.index');
Route::get('/kegiatan/{slug}', [\App\Http\Controllers\PublicKegiatanController::class, 'show'])->name('public.kegiatan.show');

Route::get('/arsip', [\App\Http\Controllers\PublicArsipController::class, 'index'])->name('public.arsip.index');

Route::get('/koleksi/{slug}', [\App\Http\Controllers\PublicKoleksiController::class, 'show'])->name('public.koleksi.show');

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

        //Profil Management
        Route::get('profil/tentang-kami', [ProfilController::class, 'tentangKami'])->name('admin.tentang-kami');
        Route::get('profil/visi-misi', [ProfilController::class, 'visiMisi'])->name('admin.visi-misi');
        Route::get('profil/struktur-organisasi', [ProfilController::class, 'strukturOrganisasi'])->name('admin.struktur-organisasi');
        Route::get('profil/tupoksi', [ProfilController::class, 'tupoksi'])->name('admin.tupoksi');
        Route::get('profil/kontak-kami', [ProfilController::class, 'kontakKami'])->name('admin.kontak-kami');
        Route::put('profil/{id}', [ProfilController::class, 'update'])->name('admin.profil.update');

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

        // Pejabat Management
        Route::resource('pejabat', PejabatController::class)->names('admin.pejabat');

        // Link Access Management
        Route::resource('link-access', LinkAccessController::class);

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
