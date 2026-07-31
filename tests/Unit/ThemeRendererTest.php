<?php

use Illuminate\Support\Facades\DB;
use Webkul\ThemeManager\Database\Seeders\ThemeAndTemplateSeeder;
use Webkul\ThemeManager\Facades\SatoraTheme;
use Webkul\ThemeManager\ThemeRenderer;

// ── ThemeRenderer Unit Tests ──

beforeEach(function () {
    $this->seed(ThemeAndTemplateSeeder::class);
    $this->renderer = app(ThemeRenderer::class);
});

test('ThemeRenderer loads without error', function () {
    $this->renderer->load();
    expect(true)->toBeTrue(); // no exception = pass
});

test('code returns active theme code', function () {
    $code = $this->renderer->code();
    expect($code)->toBeString()->not->toBeEmpty();
    $valid = ['minimal-luxury', 'modern-dark', 'colorful'];
    expect($code)->toBeIn($valid);
});

test('name returns active theme name', function () {
    $name = $this->renderer->name();
    expect($name)->toBeString()->not->toBeEmpty();
});

test('cssVariables returns string with --color- prefix', function () {
    $css = $this->renderer->cssVariables();
    expect($css)->toBeString();
    expect($css)->toContain('--color-primary');
    expect($css)->toContain('--font-display');
});

test('cssVariables contains semicolons (valid CSS)', function () {
    $css = $this->renderer->cssVariables();
    expect($css)->toContain(';');
});

test('fontLinks returns google fonts link tags', function () {
    $links = $this->renderer->fontLinks();
    expect($links)->toBeString();
    // Should contain at least one <link> tag
    expect($links)->toContain('<link');
});

test('color returns hex string for known key', function () {
    $primary = $this->renderer->color('primary');
    expect($primary)->toStartWith('#');
    expect(strlen($primary))->toBe(7); // #RRGGBB
});

test('color returns default for unknown key', function () {
    $val = $this->renderer->color('nonexistent', '#ff0000');
    expect($val)->toBe('#ff0000');
});

test('toArray returns expected keys', function () {
    $arr = $this->renderer->toArray();
    expect($arr)->toHaveKeys(['code', 'name', 'colors', 'typography']);
    expect($arr['code'])->toBeString();
    expect($arr['colors'])->toBeArray();
});

test('renderer falls back when active theme is invalid', function () {
    // Set an invalid theme code
    DB::table('core_config')->updateOrInsert(
        ['code' => 'satora.active_theme'],
        ['value' => 'nonexistent-theme', 'channel_code' => null, 'locale_code' => null]
    );

    $renderer = app(ThemeRenderer::class);
    $code = $renderer->code();
    // Should fall back to minimal-luxury
    expect($code)->toBe('minimal-luxury');
});

test('renderer respects stored active theme config', function () {
    DB::table('core_config')->updateOrInsert(
        ['code' => 'satora.active_theme'],
        ['value' => 'modern-dark', 'channel_code' => null, 'locale_code' => null]
    );

    $renderer = app(ThemeRenderer::class);
    expect($renderer->code())->toBe('modern-dark');
});

// ── SatoraTheme Facade Tests ──

test('SatoraTheme facade resolves', function () {
    expect(SatoraTheme::code())->toBeString();
});

test('SatoraTheme facade code matches renderer', function () {
    $renderer = app(ThemeRenderer::class);
    expect(SatoraTheme::code())->toBe($renderer->code());
});

test('SatoraTheme facade cssVariables is not empty', function () {
    expect(SatoraTheme::cssVariables())->not->toBeEmpty();
});

test('SatoraTheme facade name is not empty', function () {
    expect(SatoraTheme::name())->not->toBeEmpty();
});
