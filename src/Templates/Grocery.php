<?php

namespace Webkul\ThemeManager\Templates;

/**
 * Grocery Template.
 *
 * Grid-heavy layout with category tiles, deal cards, quick-add
 * functionality, and location-based store selector.
 */
class Grocery extends AbstractTemplate
{
    protected string $code = 'grocery';

    protected string $name = 'Grocery';

    protected ?string $description = 'Grid-heavy layout with category tiles, deal cards, and quick-add functionality. For grocery, food delivery, and supermarket stores.';

    protected array $sections = [
        'location-selector',
        'category-tiles',
        'daily-deals',
        'featured-products',
        'seasonal-offers',
        'brand-showcase',
        'recipe-inspiration',
        'app-download',
    ];

    protected array $navigation = [
        'primary' => [
            ['label' => 'Fruits & Veg', 'type' => 'category', 'category' => 'fruits-vegetables'],
            ['label' => 'Dairy', 'type' => 'category', 'category' => 'dairy'],
            ['label' => 'Meat', 'type' => 'category', 'category' => 'meat'],
            ['label' => 'Bakery', 'type' => 'category', 'category' => 'bakery'],
            ['label' => 'Offers', 'type' => 'link', 'url' => '/offers'],
        ],
    ];

    protected array $homepageLayout = [
        'header' => 'location-aware',
        'hero' => 'search-first',
        'product-grid' => 'compact-grid',
    ];

    protected array $defaultPages = [
        ['title' => 'About Us', 'slug' => 'about-us'],
        ['title' => 'Delivery Info', 'slug' => 'delivery'],
        ['title' => 'Recipes', 'slug' => 'recipes'],
    ];

    protected array $compatibleThemes = ['*'];
}
