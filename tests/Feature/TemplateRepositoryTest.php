<?php

use Webkul\ThemeManager\Database\Seeders\ThemeAndTemplateSeeder;
use Webkul\ThemeManager\Models\Template;
use Webkul\ThemeManager\Repositories\TemplateRepository;

// ── Template Repository Tests ──

beforeEach(function () {
    $this->seed(ThemeAndTemplateSeeder::class);
    $this->repository = app(TemplateRepository::class);
});

test('repository returns active templates', function () {
    $templates = $this->repository->getActiveTemplates();
    expect($templates)->toHaveCount(4);
});

test('repository finds template by code', function () {
    $template = $this->repository->findByCode('fashion');
    expect($template)->not->toBeNull();
    expect($template->name)->toBe('Fashion');
});

test('repository returns null for nonexistent code', function () {
    $template = $this->repository->findByCode('nonexistent');
    expect($template)->toBeNull();
});

test('template model provides sections', function () {
    $template = $this->repository->findByCode('fashion');
    expect($template->getSections())->toContain('hero-banner');
    expect($template->getHomepageLayout())->toHaveKeys(['header', 'hero', 'product-grid']);
});

test('template model navigation has expected structure', function () {
    $template = $this->repository->findByCode('grocery');
    $nav = $template->getNavigation();
    expect($nav)->toHaveKey('primary');
    expect(count($nav['primary']))->toBe(5);
});

test('template model provides default pages', function () {
    $template = $this->repository->findByCode('general');
    $pages = $template->getDefaultPages();
    expect(count($pages))->toBeGreaterThanOrEqual(2);
    expect($pages[0])->toHaveKey('title');
});
