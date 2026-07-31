<?php

namespace Webkul\ThemeManager\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Webkul\ThemeManager\Http\Controllers\Admin\TemplateController;
use Webkul\ThemeManager\Http\Controllers\Admin\ThemeController;
use Webkul\ThemeManager\Repositories\ThemeRepository;
use Webkul\ThemeManager\ThemeRenderer;

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

        // Merge admin menu items
        $this->mergeConfigFrom(
            dirname(__DIR__).'/Config/admin-menu.php', 'menu'
        );

        $this->app->singleton('satora.theme', fn () => new ThemeRenderer(
            $this->app->make(ThemeRepository::class)
        ));
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

        $this->loadViewsFrom(
            dirname(__DIR__).'/../resources/themes/components', 'satora'
        );

        $this->registerAdminRoutes();

        $this->publishes([
            dirname(__DIR__).'/Config/thememanager.php' => config_path('thememanager.php'),
        ], 'thememanager-config');

        $this->publishes([
            dirname(__DIR__).'/Resources/lang' => resource_path('lang/vendor/thememanager'),
        ], 'thememanager-lang');
    }

    /**
     * Register admin routes for theme/template management.
     */
    protected function registerAdminRoutes(): void
    {
        Route::group([
            'prefix' => config('app.admin_url'),
            'middleware' => ['web', 'admin'],
        ], function () {
            Route::prefix('satora')->group(function () {
                Route::get('themes', [ThemeController::class, 'index'])
                    ->name('admin.satora.themes.index');
                Route::post('themes/activate', [ThemeController::class, 'activate'])
                    ->name('admin.satora.themes.activate');
                Route::get('templates', [TemplateController::class, 'index'])
                    ->name('admin.satora.templates.index');
                Route::post('templates/activate', [TemplateController::class, 'activate'])
                    ->name('admin.satora.templates.activate');
            });
        });
    }
}
