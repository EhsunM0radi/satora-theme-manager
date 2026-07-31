<?php

namespace Webkul\ThemeManager\Themes;

/**
 * Modern Dark Theme.
 *
 * Bold dark-mode-first design with vibrant accent colors, crisp
 * typography, and high contrast. Ideal for tech, electronics, and gaming.
 */
class ModernDark extends AbstractTheme
{
    protected string $code = 'modern-dark';

    protected string $name = 'Modern Dark';

    protected ?string $description = 'Bold dark-mode design with vibrant accents and crisp typography. Perfect for electronics, tech, gaming, and modern brands.';

    protected array $colors = [
        'primary' => '#6366f1',
        'secondary' => '#a855f7',
        'accent' => '#06b6d4',
        'background' => '#0f172a',
        'surface' => '#1e293b',
        'text-primary' => '#f1f5f9',
        'text-secondary' => '#94a3b8',
        'border' => '#334155',
        'success' => '#22c55e',
        'error' => '#ef4444',
        'warning' => '#f59e0b',
    ];

    protected array $typography = [
        'display' => "'Space Grotesk', sans-serif",
        'heading' => "'Space Grotesk', sans-serif",
        'body' => "'DM Sans', sans-serif",
        'mono' => "'Fira Code', monospace",
    ];

    protected array $compatibleTemplates = ['*'];
}
