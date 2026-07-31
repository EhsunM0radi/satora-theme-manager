<?php

namespace Webkul\ThemeManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Webkul\ThemeManager\ThemeRenderer load()
 * @method static string cssVariables()
 * @method static string fontLinks()
 * @method static string code()
 * @method static string name()
 * @method static string color(string $key, string $default = '#000')
 * @method static array toArray()
 */
class SatoraTheme extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'satora.theme';
    }
}
