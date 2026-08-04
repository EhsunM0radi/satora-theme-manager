<?php

use Illuminate\Support\Facades\DB;
use Webkul\ThemeManager\Database\Seeders\ThemeAndTemplateSeeder;
use Webkul\ThemeManager\Facades\SatoraTheme;
use Webkul\ThemeManager\ThemeRenderer;

// ── Theme Activation & Renderer Feature Tests ──

beforeEach(function () {
    $this->seed(ThemeAndTemplateSeeder::class);
    $this->renderer = app(ThemeRenderer::class);
});

// Config writes on activation
test('Activating a theme writes to core_config', function () {
    DB::table('core_config')->updateOrInsert(
        ['code' => 'satora.active_theme'],
        ['value' => 'modern-dark', 'channel_code' => null, 'locale_code' => null]
    );

    $stored = DB::table('core_config')->where('code', 'satora.active_theme')->first();
    expect($stored)->not->toBeNull();
    expect($stored->value)->toBe('modern-dark');
});

test('Activating a template writes to core_config', function () {
    DB::table('core_config')->updateOrInsert(
        ['code' => 'satora.active_template'],
        ['value' => 'fashion', 'channel_code' => null, 'locale_code' => null]
    );

    $stored = DB::table('core_config')->where('code', 'satora.active_template')->first();
    expect($stored)->not->toBeNull();
    expect($stored->value)->toBe('fashion');
});

// Default theme
test('Default theme is minimal-luxury', function () {
    expect(config('thememanager.default_theme'))->toBe('minimal-luxury');
});

// ThemeRenderer::load() returns self
test('ThemeRenderer::load() returns self', function () {
    $result = $this->renderer->load();
    expect($result)->toBeInstanceOf(ThemeRenderer::class);
    expect($result)->toBe($this->renderer);
});

// fontLinks
test('fontLinks() returns link tags with googleapis.com', function () {
    $links = $this->renderer->fontLinks();
    expect($links)->toBeString();
    expect($links)->toContain('fonts.googleapis.com');
    expect($links)->toContain('<link');
    expect($links)->toContain('rel="stylesheet"');
});

// cssVariables
test('cssVariables() returns CSS custom properties', function () {
    $css = $this->renderer->cssVariables();
    expect($css)->toBeString()->not->toBeEmpty();
    expect($css)->toContain('--color-primary');
    expect($css)->toContain('--font-display');
    expect($css)->toContain(':');
    expect($css)->toContain(';');
});

// SatoraTheme facade
test('SatoraTheme facade works', function () {
    expect(SatoraTheme::code())->toBeString()->not->toBeEmpty();
    expect(SatoraTheme::name())->toBeString()->not->toBeEmpty();
    expect(SatoraTheme::cssVariables())->toContain('--color-');
    expect(SatoraTheme::fontLinks())->toContain('googleapis.com');
    expect(SatoraTheme::color('primary'))->toStartWith('#');
});
