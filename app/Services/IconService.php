<?php

namespace App\Services;

use App\Models\LinkAccess;

class IconService
{
    /**
     * Get all available icons from config
     */
    public function getAllIcons(): array
    {
        return config('icons', []);
    }

    /**
     * Get flattened array of all icons
     */
    public function getFlattenedIcons(): array
    {
        $allIcons = $this->getAllIcons();
        $flattened = [];

        foreach ($allIcons as $category => $icons) {
            foreach ($icons as $key => $svg) {
                $flattened["{$category}.{$key}"] = $svg;
            }
        }

        return $flattened;
    }

    /**
     * Generate a consistent hash for a link based on judul and URL
     */
    public function generateIconHash(string $judul, ?string $url): int
    {
        $url = $url ?? '';
        $combined = strtolower(trim($judul) . '|' . trim($url));
        return crc32($combined);
    }

    /**
     * Get icon for a link based on keywords or hash
     */
    public function getIconForLink(LinkAccess $link): ?string
    {
        // If link already has custom icon, return it
        if (!empty($link->icon_svg)) {
            return $link->icon_svg;
        }

        // Try keyword-based matching first
        $icon = $this->getIconByKeywords($link->judul, $link->url);
        if ($icon) {
            return $icon;
        }

        // Fallback to hash-based assignment
        return $this->getIconByHash($link);
    }

    /**
     * Get icon based on keywords in judul/URL
     */
    public function getIconByKeywords(string $judul, ?string $url): ?string
    {
        $keywords = [
            'opac' => 'library.book-open',
            'katalog' => 'library.book-open',
            'epermus' => 'library.book-stack',
            'e-permus' => 'library.book-stack',
            'eperpus' => 'library.book-stack',
            'e-perpus' => 'library.book-stack',
            'arsip' => 'archive.archive-box',
            'sikn' => 'archive.archive-box',
            'jdih' => 'archive.document-text',
            'anggota' => 'membership.user-group',
            'daftar' => 'membership.user-plus',
            'registrasi' => 'membership.user-plus',
            'registrasion' => 'membership.user-plus',
        ];

        $searchText = strtolower($judul . ' ' . $url);

        foreach ($keywords as $keyword => $iconPath) {
            if (str_contains($searchText, $keyword)) {
                return $this->getIconByPath($iconPath);
            }
        }

        return null;
    }

    /**
     * Get icon based on hash (consistent random assignment)
     */
    public function getIconByHash(LinkAccess $link): string
    {
        $icons = $this->getFlattenedIcons();
        $hash = $this->generateIconHash($link->judul, $link->url);
        $index = abs($hash) % count($icons);

        return array_values($icons)[$index];
    }

    /**
     * Get icon by config path (e.g., 'library.book-open')
     */
    public function getIconByPath(string $path): ?string
    {
        $keys = explode('.', $path);
        $icon = config('icons');

        foreach ($keys as $key) {
            if (!isset($icon[$key])) {
                return null;
            }
            $icon = $icon[$key];
        }

        return is_string($icon) ? $icon : null;
    }

    /**
     * Auto-assign icons to all links that don't have one
     */
    public function autoAssignIconsToMissing(): int
    {
        $links = LinkAccess::whereNull('icon_svg')
            ->orWhere('icon_svg', '')
            ->get();

        $count = 0;
        foreach ($links as $link) {
            $icon = $this->getIconByHash($link);
            if ($icon) {
                $link->update(['icon_svg' => $icon]);
                $count++;
            }
        }

        return $count;
    }
}
