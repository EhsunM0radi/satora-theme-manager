<?php

namespace Webkul\ThemeManager\Themes;

/**
 * Minimal Luxury Theme.
 *
 * Clean, elegant design with neutral tones, refined typography, and
 * generous whitespace. Inspired by high-end fashion and luxury brands.
 */
class MinimalLuxury extends AbstractTheme
{
    protected string $code = 'minimal-luxury';

    protected string $name = 'Minimal Luxury';

    protected ?string $description = 'Clean, elegant design with neutral tones and refined typography. Perfect for luxury fashion, jewelry, and premium brands.';

    protected array $colors = [
        'primary' => '#1a1a2e',
        'secondary' => '#e94560',
        'accent' => '#0f3460',
        'background' => '#ffffff',
        'surface' => '#f8f9fa',
        'text-primary' => '#1a1a2e',
        'text-secondary' => '#6c757d',
        'border' => '#dee2e6',
        'success' => '#2d6a4f',
        'error' => '#d32f2f',
        'warning' => '#f9a825',
    ];

    protected array $typography = [
        'display' => "'Playfair Display', serif",
        'heading' => "'Playfair Display', serif",
        'body' => "'Inter', sans-serif",
        'mono' => "'JetBrains Mono', monospace",
    ];

    protected array $compatibleTemplates = ['*'];
}
