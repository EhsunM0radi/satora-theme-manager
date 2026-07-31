<?php

namespace Webkul\ThemeManager;

use Illuminate\Support\Facades\DB;
use Webkul\ThemeManager\Repositories\ThemeRepository;

/**
 * Reads the currently active Satora theme and provides
 * CSS variables, fonts, and asset paths for rendering.
 */
class ThemeRenderer
{
    protected ?object $theme = null;

    public function __construct(protected ThemeRepository $themeRepository) {}

    /**
     * Load the active theme from config or fallback.
     */
    public function load(): self
    {
        $code = DB::table('core_config')->where('code', 'satora.active_theme')->value('value')
            ?? config('thememanager.default_theme', 'minimal-luxury');

        $this->theme = $this->themeRepository->findByCode($code);

        if (! $this->theme) {
            $this->theme = $this->themeRepository->findByCode('minimal-luxury');
        }

        return $this;
    }

    /**
     * Get CSS custom properties <style> block for the active theme.
     */
    public function cssVariables(): string
    {
        if (! $this->theme) {
            $this->load();
        }

        return $this->theme?->getCssVariables() ?? '';
    }

    /**
     * Get Google Fonts <link> tags for the active theme.
     */
    public function fontLinks(): string
    {
        if (! $this->theme) {
            $this->load();
        }

        $typography = $this->theme?->getTypography() ?? [];

        $fonts = [];
        $seen = [];

        foreach ($typography as $role => $family) {
            // Extract font name from CSS font-family value
            $name = trim(explode(',', $family)[0], "'\"");
            if ($name && ! in_array($name, $seen)) {
                $seen[] = $name;
                $slug = str_replace(' ', '+', $name);
                $fonts[] = "<link href=\"https://fonts.googleapis.com/css2?family={$slug}:wght@300;400;500;600;700&display=swap\" rel=\"stylesheet\">";
            }
        }

        return implode("\n    ", $fonts);
    }

    /**
     * Get the active theme code.
     */
    public function code(): string
    {
        if (! $this->theme) {
            $this->load();
        }

        return $this->theme?->code ?? 'minimal-luxury';
    }

    /**
     * Get the active theme name.
     */
    public function name(): string
    {
        if (! $this->theme) {
            $this->load();
        }

        return $this->theme?->name ?? 'Minimal Luxury';
    }

    /**
     * Get a specific color from the active theme.
     */
    public function color(string $key, string $default = '#000'): string
    {
        if (! $this->theme) {
            $this->load();
        }

        $colors = $this->theme?->getColors() ?? [];

        return $colors[$key] ?? $default;
    }

    /**
     * Get all theme data as array for the frontend.
     */
    public function toArray(): array
    {
        if (! $this->theme) {
            $this->load();
        }

        return $this->theme?->toArray() ?? [];
    }
}
