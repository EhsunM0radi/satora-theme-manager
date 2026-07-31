<?php

namespace Webkul\ThemeManager\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/Config/thememanager.php', 'thememanager'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(dirname(__DIR__).'/Database/Migrations');

        $this->loadTranslationsFrom(
            dirname(__DIR__).'/Resources/lang', 'thememanager'
        );

        $this->publishes([
            dirname(__DIR__).'/Config/thememanager.php' => config_path('thememanager.php'),
        ], 'thememanager-config');

        $this->publishes([
            dirname(__DIR__).'/Resources/lang' => resource_path('lang/vendor/thememanager'),
        ], 'thememanager-lang');
    }
}
