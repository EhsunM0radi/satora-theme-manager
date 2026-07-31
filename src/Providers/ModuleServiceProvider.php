<?php

namespace Webkul\ThemeManager\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Webkul\ThemeManager\Models\Template;
use Webkul\ThemeManager\Models\Theme;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        Theme::class,
        Template::class,
    ];
}
