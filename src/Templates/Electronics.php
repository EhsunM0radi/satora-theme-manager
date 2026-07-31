<?php

namespace Webkul\ThemeManager\Templates;

/**
 * Electronics Template.
 *
 * Spec-driven layout with comparison tables, feature highlights,
 * tech specs sections, and category-based navigation.
 */
class Electronics extends AbstractTemplate
{
    protected string $code = 'electronics';

    protected string $name = 'Electronics';

    protected ?string $description = 'Spec-driven layout with comparison tables, feature highlights, and technical product displays. For gadgets, electronics, and tech stores.';

    protected array $sections = [
        'hero-banner',
        'category-grid',
        'featured-products',
        'deals-of-the-day',
        'brand-showcase',
        'comparison-section',
        'tech-blog-preview',
        'reviews',
        'newsletter',
    ];

    protected array $navigation = [
        'primary' => [
            ['label' => 'Smartphones', 'type' => 'category', 'category' => 'smartphones'],
            ['label' => 'Laptops', 'type' => 'category', 'category' => 'laptops'],
            ['label' => 'Audio', 'type' => 'category', 'category' => 'audio'],
            ['label' => 'Accessories', 'type' => 'category', 'category' => 'accessories'],
            ['label' => 'Deals', 'type' => 'link', 'url' => '/deals'],
        ],
    ];

    protected array $homepageLayout = [
        'header' => 'standard-light',
        'hero' => 'single-banner',
        'product-grid' => '4-column',
    ];

    protected array $defaultPages = [
        ['title' => 'About Us', 'slug' => 'about-us'],
        ['title' => 'Tech Blog', 'slug' => 'blog'],
        ['title' => 'Compare Products', 'slug' => 'compare'],
    ];

    protected array $compatibleThemes = ['*'];
}
