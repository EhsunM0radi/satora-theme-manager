<?php

use Webkul\ThemeManager\Contracts\Theme as ThemeContract;
use Webkul\ThemeManager\Themes\MinimalLuxury;
use Webkul\ThemeManager\Themes\ModernDark;
use Webkul\ThemeManager\Themes\Colorful;

// ── Theme Contract Tests ──

test('MinimalLuxury implements Theme contract', function () {
    $theme = new MinimalLuxury;
    expect($theme)->toBeInstanceOf(ThemeContract::class);
});

test('MinimalLuxury returns correct code', function () {
    $theme = new MinimalLuxury;
    expect($theme->getCode())->toBe('minimal-luxury');
});

test('MinimalLuxury returns correct name', function () {
    $theme = new MinimalLuxury;
    expect($theme->getName())->toBe('Minimal Luxury');
});

test('MinimalLuxury provides colors array', function () {
    $theme = new MinimalLuxury;
    $colors = $theme->getColors();
    expect($colors)->toBeArray()
        ->toHaveKeys(['primary', 'secondary', 'accent', 'background', 'text-primary']);
});

test('MinimalLuxury provides typography array', function () {
    $theme = new MinimalLuxury;
    $typography = $theme->getTypography();
    expect($typography)->toBeArray()
        ->toHaveKeys(['display', 'heading', 'body', 'mono']);
});

test('MinimalLuxury generates CSS variables', function () {
    $theme = new MinimalLuxury;
    $css = $theme->getCssVariables();
    expect($css)->toContain('--color-primary')
        ->toContain('--font-display');
});

test('MinimalLuxury is compatible with all templates by default', function () {
    $theme = new MinimalLuxury;
    expect($theme->isCompatibleWith('fashion'))->toBeTrue();
    expect($theme->isCompatibleWith('grocery'))->toBeTrue();
    expect($theme->isCompatibleWith('nonexistent'))->toBeTrue();
});

test('MinimalLuxury toArray returns all keys', function () {
    $theme = new MinimalLuxury;
    $array = $theme->toArray();
    expect($array)->toHaveKeys(['code', 'name', 'colors', 'typography', 'compatible_templates']);
    expect($array['code'])->toBe('minimal-luxury');
});

// ── Multiple theme variants ──

test('ModernDark uses dark background', function () {
    $theme = new ModernDark;
    $colors = $theme->getColors();
    expect($colors['background'])->toBe('#0f172a');
});

test('Colorful is universally compatible', function () {
    $theme = new Colorful;
    expect($theme->isCompatibleWith('any-template'))->toBeTrue();
});

test('All three themes return unique codes', function () {
    $codes = [
        (new MinimalLuxury)->getCode(),
        (new ModernDark)->getCode(),
        (new Colorful)->getCode(),
    ];
    expect($codes)->toBe([$codes[0], $codes[1], $codes[2]]);
    expect(count(array_unique($codes)))->toBe(3);
});
