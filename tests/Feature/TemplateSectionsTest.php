<?php

use Webkul\ThemeManager\Database\Seeders\ThemeAndTemplateSeeder;
use Webkul\ThemeManager\Repositories\TemplateRepository;

// ── Template Sections & Layout Feature Tests ──

beforeEach(function () {
    $this->seed(ThemeAndTemplateSeeder::class);
    $this->repository = app(TemplateRepository::class);
});

// Fashion template homepage layout
test('Fashion template homepageLayout has header, hero, product-grid', function () {
    $template = $this->repository->findByCode('fashion');
    expect($template)->not->toBeNull();

    $layout = $template->getHomepageLayout();
    expect($layout)->toHaveKeys(['header', 'hero', 'product-grid']);
    expect($layout['header'])->toBe('transparent-hero');
    expect($layout['hero'])->toBe('fullscreen-slider');
    expect($layout['product-grid'])->toBe('3-column');
});

// Electronics template homepage layout
test('Electronics template has correct homepage layout', function () {
    $template = $this->repository->findByCode('electronics');
    expect($template)->not->toBeNull();

    $layout = $template->getHomepageLayout();
    expect($layout)->toHaveKeys(['header', 'hero', 'product-grid']);
    expect($layout['header'])->toBe('standard-light');
    expect($layout['hero'])->toBe('single-banner');
    expect($layout['product-grid'])->toBe('4-column');
});

// Grocery template homepage layout
test('Grocery template homepage layout has location-aware header', function () {
    $template = $this->repository->findByCode('grocery');
    expect($template)->not->toBeNull();

    $layout = $template->getHomepageLayout();
    expect($layout)->toHaveKeys(['header', 'hero', 'product-grid']);
    expect($layout['header'])->toBe('location-aware');
    expect($layout['hero'])->toBe('search-first');
});

// General template basic sections
test('General template has basic sections', function () {
    $template = $this->repository->findByCode('general');
    expect($template)->not->toBeNull();

    $sections = $template->getSections();
    expect($sections)->toContain('hero-banner');
    expect($sections)->toContain('category-grid');
    expect($sections)->toContain('newsletter');

    $layout = $template->getHomepageLayout();
    expect($layout)->toHaveKeys(['header', 'hero', 'product-grid']);
    expect($layout['header'])->toBe('standard');
    expect($layout['product-grid'])->toBe('4-column');
});

// Template::isCompatibleWith('*')
test('Template::isCompatibleWith(\'*\') returns true', function () {
    $template = $this->repository->findByCode('fashion');
    expect($template)->not->toBeNull();
    expect($template->isCompatibleWith('*'))->toBeTrue();

    $templates = ['fashion', 'electronics', 'grocery', 'general'];
    foreach ($templates as $code) {
        $t = $this->repository->findByCode($code);
        expect($t->isCompatibleWith('minimal-luxury'))->toBeTrue();
        expect($t->isCompatibleWith('modern-dark'))->toBeTrue();
        expect($t->isCompatibleWith('colorful'))->toBeTrue();
    }
});
