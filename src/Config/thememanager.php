<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Theme Manager Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for the Satora Theme/Template management system.
    | Themes define visual identity (colors, typography, branding).
    | Templates define page structure (layouts, sections, navigation).
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Default Theme
    |--------------------------------------------------------------------------
    */
    'default_theme' => env('SATORA_DEFAULT_THEME', 'minimal-luxury'),

    /*
    |--------------------------------------------------------------------------
    | Default Template
    |--------------------------------------------------------------------------
    */
    'default_template' => env('SATORA_DEFAULT_TEMPLATE', 'general'),

    /*
    |--------------------------------------------------------------------------
    | Available Theme Classes
    |--------------------------------------------------------------------------
    |
    | Register custom theme classes here. Each class must implement
    | Webkul\ThemeManager\Contracts\Theme.
    |
    */
    'theme_classes' => [
        // \Webkul\ThemeManager\Themes\MinimalLuxury::class,
        // \Webkul\ThemeManager\Themes\ModernDark::class,
        // \Webkul\ThemeManager\Themes\Colorful::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Available Template Classes
    |--------------------------------------------------------------------------
    |
    | Register custom template classes here. Each class must implement
    | Webkul\ThemeManager\Contracts\Template.
    |
    */
    'template_classes' => [
        // \Webkul\ThemeManager\Templates\Fashion::class,
        // \Webkul\ThemeManager\Templates\Electronics::class,
        // \Webkul\ThemeManager\Templates\Grocery::class,
        // \Webkul\ThemeManager\Templates\Digital::class,
        // \Webkul\ThemeManager\Templates\General::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | RTL-Aware
    |--------------------------------------------------------------------------
    |
    | Automatically inject RTL CSS overrides when the locale direction is 'rtl'.
    | Enabled by default.
    |
    */
    'rtl_aware' => true,

    /*
    |--------------------------------------------------------------------------
    | Theme Preview Path
    |--------------------------------------------------------------------------
    |
    | Path where theme and template preview images are stored, relative
    | to the public directory.
    |
    */
    'preview_path' => 'themes/previews',
];
