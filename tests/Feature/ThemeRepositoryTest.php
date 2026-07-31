<?php

use Webkul\ThemeManager\Models\Theme;
use Webkul\ThemeManager\Repositories\ThemeRepository;
use Webkul\ThemeManager\Database\Seeders\ThemeAndTemplateSeeder;

// ── Theme Repository Tests ──

beforeEach(function () {
    $this->seed(ThemeAndTemplateSeeder::class);
    $this->repository = app(ThemeRepository::class);
});

test('repository returns active themes', function () {
    $themes = $this->repository->getActiveThemes();
    expect($themes)->toHaveCount(3);
});

test('repository finds theme by code', function () {
    $theme = $this->repository->findByCode('minimal-luxury');
    expect($theme)->not->toBeNull();
    expect($theme->name)->toBe('Minimal Luxury');
});

test('repository returns null for nonexistent code', function () {
    $theme = $this->repository->findByCode('nonexistent');
    expect($theme)->toBeNull();
});

test('repository returns compatible themes with template', function () {
    $themes = $this->repository->getCompatibleWithTemplate('fashion');
    expect($themes)->toHaveCount(3); // All themes are universally compatible
});

test('theme model implements contracts', function () {
    $theme = $this->repository->findByCode('minimal-luxury');
    expect($theme->getCode())->toBe('minimal-luxury');
    expect($theme->getName())->toBe('Minimal Luxury');
    expect($theme->getColors())->toBeArray();
    expect($theme->getTypography())->toBeArray();
    expect($theme->getCssVariables())->toContain('--color-');
});

test('theme model compatibility check', function () {
    $theme = $this->repository->findByCode('minimal-luxury');
    expect($theme->isCompatibleWith('fashion'))->toBeTrue();
    expect($theme->isCompatibleWith('grocery'))->toBeTrue();
});
