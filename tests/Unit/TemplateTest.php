<?php

use Webkul\ThemeManager\Contracts\Template as TemplateContract;
use Webkul\ThemeManager\Templates\Electronics;
use Webkul\ThemeManager\Templates\Fashion;
use Webkul\ThemeManager\Templates\General;
use Webkul\ThemeManager\Templates\Grocery;

// ── Template Contract Tests ──

test('Fashion implements Template contract', function () {
    $template = new Fashion;
    expect($template)->toBeInstanceOf(TemplateContract::class);
});

test('Fashion returns correct code and name', function () {
    $template = new Fashion;
    expect($template->getCode())->toBe('fashion');
    expect($template->getName())->toBe('Fashion');
});

test('Fashion provides sections array', function () {
    $template = new Fashion;
    $sections = $template->getSections();
    expect($sections)->toBeArray()
        ->toContain('hero-banner')
        ->toContain('lookbook')
        ->toContain('new-arrivals');
});

test('Fashion provides navigation structure', function () {
    $template = new Fashion;
    $nav = $template->getNavigation();
    expect($nav)->toHaveKey('primary');
    expect($nav['primary'])->toBeArray();
    expect(count($nav['primary']))->toBeGreaterThan(0);
});

test('Fashion provides homepage layout', function () {
    $template = new Fashion;
    $layout = $template->getHomepageLayout();
    expect($layout)->toHaveKeys(['header', 'hero', 'product-grid']);
});

test('Fashion provides default pages', function () {
    $template = new Fashion;
    $pages = $template->getDefaultPages();
    expect($pages)->toBeArray();
    expect(count($pages))->toBeGreaterThan(0);
    expect($pages[0])->toHaveKey('title');
    expect($pages[0])->toHaveKey('slug');
});

test('Fashion is compatible with all themes by default', function () {
    $template = new Fashion;
    expect($template->isCompatibleWith('minimal-luxury'))->toBeTrue();
    expect($template->isCompatibleWith('modern-dark'))->toBeTrue();
});

test('Electronics template recommends spec-driven layout', function () {
    $template = new Electronics;
    expect($template->getSections())->toContain('comparison-section');
    expect($template->getSections())->toContain('tech-blog-preview');
});

test('Grocery template has search-first hero', function () {
    $template = new Grocery;
    $layout = $template->getHomepageLayout();
    expect($layout['hero'])->toBe('search-first');
});

test('General template has standard ecommerce sections', function () {
    $template = new General;
    expect($template->getSections())->toContain('hero-banner');
    expect($template->getSections())->toContain('featured-products');
    expect($template->getSections())->toContain('newsletter');
});

test('All four templates return unique codes', function () {
    $codes = [
        (new Fashion)->getCode(),
        (new Electronics)->getCode(),
        (new Grocery)->getCode(),
        (new General)->getCode(),
    ];
    expect(count(array_unique($codes)))->toBe(4);
});

test('Template toArray returns all expected keys', function () {
    $template = new Fashion;
    $array = $template->toArray();
    expect($array)->toHaveKeys([
        'code', 'name', 'sections', 'navigation',
        'homepage_layout', 'default_pages', 'compatible_themes',
    ]);
});
