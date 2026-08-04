<?php

use Webkul\ThemeManager\Themes\Colorful;
use Webkul\ThemeManager\Themes\MinimalLuxury;
use Webkul\ThemeManager\Themes\ModernDark;

// ── Theme Compatibility & Configuration Tests ──

// Compatibility with all templates
test('MinimalLuxury is compatible with all templates', function () {
    $theme = new MinimalLuxury;
    expect($theme->getCompatibleTemplates())->toBe(['*']);
    expect($theme->isCompatibleWith('fashion'))->toBeTrue();
    expect($theme->isCompatibleWith('electronics'))->toBeTrue();
    expect($theme->isCompatibleWith('grocery'))->toBeTrue();
    expect($theme->isCompatibleWith('general'))->toBeTrue();
    expect($theme->isCompatibleWith('any-random-template'))->toBeTrue();
});

test('ModernDark is compatible with all templates', function () {
    $theme = new ModernDark;
    expect($theme->getCompatibleTemplates())->toBe(['*']);
    expect($theme->isCompatibleWith('fashion'))->toBeTrue();
    expect($theme->isCompatibleWith('electronics'))->toBeTrue();
    expect($theme->isCompatibleWith('grocery'))->toBeTrue();
    expect($theme->isCompatibleWith('general'))->toBeTrue();
});

test('Colorful is compatible with all templates', function () {
    $theme = new Colorful;
    expect($theme->getCompatibleTemplates())->toBe(['*']);
    expect($theme->isCompatibleWith('fashion'))->toBeTrue();
    expect($theme->isCompatibleWith('any-template'))->toBeTrue();
});

// Color count
test('All themes return 11 colors', function () {
    $themes = [new MinimalLuxury, new ModernDark, new Colorful];
    foreach ($themes as $theme) {
        expect($theme->getColors())->toHaveCount(11);
    }
});

// Font family count
test('All themes return 4 font families', function () {
    $themes = [new MinimalLuxury, new ModernDark, new Colorful];
    foreach ($themes as $theme) {
        expect($theme->getTypography())->toHaveCount(4);
        expect($theme->getTypography())->toHaveKeys(['display', 'heading', 'body', 'mono']);
    }
});

// CSS variables structure
test('CSS variables string contains --color- and --font- prefixes', function () {
    $themes = [new MinimalLuxury, new ModernDark, new Colorful];
    foreach ($themes as $theme) {
        $css = $theme->getCssVariables();
        expect($css)->toContain('--color-');
        expect($css)->toContain('--font-');
    }
});

test('getCssVariables returns non-empty string', function () {
    $themes = [new MinimalLuxury, new ModernDark, new Colorful];
    foreach ($themes as $theme) {
        expect($theme->getCssVariables())->toBeString()->not->toBeEmpty();
    }
});
