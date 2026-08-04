<?php

use Webkul\ThemeManager\Templates\Electronics;
use Webkul\ThemeManager\Templates\Fashion;
use Webkul\ThemeManager\Templates\General;
use Webkul\ThemeManager\Templates\Grocery;

// ── Template Compatibility & Configuration Tests ──

// Section counts
test('Fashion template has 9 sections', function () {
    $template = new Fashion;
    expect($template->getSections())->toHaveCount(9);
});

test('Electronics template has sections', function () {
    $template = new Electronics;
    $sections = $template->getSections();
    expect($sections)->toBeArray()->not->toBeEmpty();
    expect($sections)->toHaveCount(9);
    expect($sections)->toContain('hero-banner');
    expect($sections)->toContain('comparison-section');
});

test('Grocery template has sections', function () {
    $template = new Grocery;
    $sections = $template->getSections();
    expect($sections)->toBeArray()->not->toBeEmpty();
    expect($sections)->toHaveCount(8);
    expect($sections)->toContain('location-selector');
    expect($sections)->toContain('daily-deals');
});

test('General template has sections', function () {
    $template = new General;
    $sections = $template->getSections();
    expect($sections)->toBeArray()->not->toBeEmpty();
    expect($sections)->toHaveCount(9);
    expect($sections)->toContain('hero-banner');
    expect($sections)->toContain('newsletter');
});

// Navigation
test('Fashion template has 5 primary nav items', function () {
    $template = new Fashion;
    $nav = $template->getNavigation();
    expect($nav)->toHaveKey('primary');
    expect($nav['primary'])->toHaveCount(5);
});

// Default pages
test('Fashion has 3 default pages', function () {
    $template = new Fashion;
    $pages = $template->getDefaultPages();
    expect($pages)->toHaveCount(3);
    expect($pages[0])->toMatchArray(['title' => 'About Us', 'slug' => 'about-us']);
});

// Universal compatibility
test('All templates are compatible with all themes', function () {
    $templates = [new Fashion, new Electronics, new Grocery, new General];
    $themeCodes = ['minimal-luxury', 'modern-dark', 'colorful'];

    foreach ($templates as $template) {
        expect($template->getCompatibleThemes())->toBe(['*']);
        foreach ($themeCodes as $code) {
            expect($template->isCompatibleWith($code))->toBeTrue();
        }
    }
});
