<?php

namespace App\Console\Commands;

use App\Services\IconService;
use App\Models\LinkAccess;
use Illuminate\Console\Command;

class AssignLinkIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:assign-icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically assign SVG icons to all links that do not have one';

    /**
     * The icon service instance.
     *
     * @var \App\Services\IconService
     */
    protected $iconService;

    /**
     * Create a new command instance.
     *
     * @param  \App\Services\IconService  $iconService
     * @return void
     */
    public function __construct(IconService $iconService)
    {
        parent::__construct();
        $this->iconService = $iconService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Memulai penugasan icon otomatis...');
        $this->newLine();

        // Find all links without icons
        $links = LinkAccess::whereNull('icon_svg')
            ->orWhere('icon_svg', '')
            ->get();

        if ($links->isEmpty()) {
            $this->info('✓ Semua link sudah memiliki icon.');
            $this->info('Tidak ada icon yang perlu ditugaskan.');
            return Command::SUCCESS;
        }

        $this->info("Ditemukan {$links->count()} link yang belum memiliki icon.");
        $this->newLine();

        $bar = $this->output->createProgressBar($links->count());
        $bar->start();

        $assigned = 0;
        $keywords = 0;
        $hash = 0;

        foreach ($links as $link) {
            // Check if icon was assigned by keywords
            $keywordIcon = $this->iconService->getIconByKeywords($link->judul, $link->url);
            $icon = $keywordIcon ?: $this->iconService->getIconByHash($link);

            if ($icon) {
                $link->update(['icon_svg' => $icon]);
                $assigned++;

                if ($keywordIcon) {
                    $keywords++;
                } else {
                    $hash++;
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("✓ Berhasil menugaskan icon ke {$assigned} link:");

        if ($keywords > 0) {
            $this->line("  - Berdasarkan kata kunci: {$keywords} link");
        }

        if ($hash > 0) {
            $this->line("  - Berdasarkan hash (otomatis): {$hash} link");
        }

        $this->newLine();
        $this->info('Icon sekarang siap ditampilkan di halaman publik dan admin.');

        return Command::SUCCESS;
    }
}
