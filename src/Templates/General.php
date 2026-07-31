<?php

namespace Webkul\ThemeManager\Templates;

/**
 * General Template.
 *
 * Flexible, all-purpose layout suitable for any business type.
 * Clean, standard ecommerce layout with hero, categories, products,
 * testimonials, and newsletter sections.
 */
class General extends AbstractTemplate
{
    protected string $code = 'general';

    protected string $name = 'General';

    protected ?string $description = 'Flexible, all-purpose ecommerce layout suitable for any type of business. Clean and standard.';

    protected array $sections = [
        'hero-banner',
        'category-grid',
        'featured-products',
        'best-sellers',
        'promo-banner',
        'new-arrivals',
        'brand-showcase',
        'testimonials',
        'newsletter',
    ];

    protected array $navigation = [
        'primary' => [
            ['label' => 'Shop', 'type' => 'link', 'url' => '/shop'],
            ['label' => 'Categories', 'type' => 'categories'],
            ['label' => 'Deals', 'type' => 'link', 'url' => '/deals'],
            ['label' => 'About', 'type' => 'link', 'url' => '/about-us'],
            ['label' => 'Contact', 'type' => 'link', 'url' => '/contact-us'],
        ],
    ];

    protected array $homepageLayout = [
        'header' => 'standard',
        'hero' => 'single-banner',
        'product-grid' => '4-column',
    ];

    protected array $defaultPages = [
        ['title' => 'About Us', 'slug' => 'about-us'],
        ['title' => 'Contact Us', 'slug' => 'contact-us'],
        ['title' => 'Privacy Policy', 'slug' => 'privacy-policy'],
        ['title' => 'Terms & Conditions', 'slug' => 'terms-conditions'],
    ];

    protected array $compatibleThemes = ['*'];
}
