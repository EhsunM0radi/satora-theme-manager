<?php

namespace Webkul\ThemeManager\Themes;

/**
 * Colorful Theme.
 *
 * Vibrant, energetic design with bold color palettes and playful
 * typography. Great for fashion, beauty, kids' stores, and lifestyle.
 */
class Colorful extends AbstractTheme
{
    protected string $code = 'colorful';

    protected string $name = 'Colorful';

    protected ?string $description = 'Vibrant, energetic design with bold colors and playful typography. Ideal for fashion, beauty, kids, and lifestyle brands.';

    protected array $colors = [
        'primary' => '#ff6b6b',
        'secondary' => '#feca57',
        'accent' => '#48dbfb',
        'background' => '#ffffff',
        'surface' => '#fff9f0',
        'text-primary' => '#2d3436',
        'text-secondary' => '#636e72',
        'border' => '#dfe6e9',
        'success' => '#00b894',
        'error' => '#d63031',
        'warning' => '#fdcb6e',
    ];

    protected array $typography = [
        'display' => "'Poppins', sans-serif",
        'heading' => "'Poppins', sans-serif",
        'body' => "'Nunito', sans-serif",
        'mono' => "'JetBrains Mono', monospace",
    ];

    protected array $compatibleTemplates = ['*'];
}
