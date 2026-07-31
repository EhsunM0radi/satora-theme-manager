<?php

namespace Webkul\ThemeManager\Templates;

/**
 * Fashion Template.
 *
 * Hero-driven layout with large imagery, featured collections,
 * lookbook sections, new arrivals grid, and Instagram-style gallery.
 */
class Fashion extends AbstractTemplate
{
    protected string $code = 'fashion';

    protected string $name = 'Fashion';

    protected ?string $description = 'Hero-driven layout with large imagery, lookbook sections, and editorial-style product displays. For clothing, accessories, and fashion brands.';

    protected array $sections = [
        'hero-banner',
        'featured-collections',
        'new-arrivals',
        'trending-now',
        'lookbook',
        'category-showcase',
        'testimonials',
        'instagram-gallery',
        'newsletter',
    ];

    protected array $navigation = [
        'primary' => [
            ['label' => 'New In', 'type' => 'link', 'url' => '/new'],
            ['label' => 'Clothing', 'type' => 'category', 'category' => 'clothing'],
            ['label' => 'Accessories', 'type' => 'category', 'category' => 'accessories'],
            ['label' => 'Collections', 'type' => 'link', 'url' => '/collections'],
            ['label' => 'Sale', 'type' => 'link', 'url' => '/sale'],
        ],
    ];

    protected array $homepageLayout = [
        'header' => 'transparent-hero',
        'hero' => 'fullscreen-slider',
        'product-grid' => '3-column',
    ];

    protected array $defaultPages = [
        ['title' => 'About Us', 'slug' => 'about-us'],
        ['title' => 'Lookbook', 'slug' => 'lookbook'],
        ['title' => 'Size Guide', 'slug' => 'size-guide'],
    ];

    protected array $compatibleThemes = ['*'];
}
