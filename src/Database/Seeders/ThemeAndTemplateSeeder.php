<?php

namespace Webkul\ThemeManager\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webkul\ThemeManager\Templates\Electronics;
use Webkul\ThemeManager\Templates\Fashion;
use Webkul\ThemeManager\Templates\General;
use Webkul\ThemeManager\Templates\Grocery;
use Webkul\ThemeManager\Themes\Colorful;
use Webkul\ThemeManager\Themes\MinimalLuxury;
use Webkul\ThemeManager\Themes\ModernDark;

class ThemeAndTemplateSeeder extends Seeder
{
    public function run(): void
    {
        // Themes
        $themes = [
            new MinimalLuxury,
            new ModernDark,
            new Colorful,
        ];

        foreach ($themes as $index => $theme) {
            DB::table('satora_themes')->updateOrInsert(
                ['code' => $theme->getCode()],
                [
                    'name' => $theme->getName(),
                    'description' => $theme->getDescription(),
                    'colors' => json_encode($theme->getColors()),
                    'typography' => json_encode($theme->getTypography()),
                    'is_active' => true,
                    'sort_order' => $index + 1,
                    'metadata' => json_encode([
                        'compatible_templates' => $theme->getCompatibleTemplates(),
                    ]),
                    'updated_at' => now(),
                ]
            );
        }

        // Templates
        $templates = [
            new Fashion,
            new Electronics,
            new Grocery,
            new General,
        ];

        foreach ($templates as $index => $template) {
            DB::table('satora_templates')->updateOrInsert(
                ['code' => $template->getCode()],
                [
                    'name' => $template->getName(),
                    'description' => $template->getDescription(),
                    'sections' => json_encode($template->getSections()),
                    'navigation' => json_encode($template->getNavigation()),
                    'homepage_layout' => json_encode($template->getHomepageLayout()),
                    'default_pages' => json_encode($template->getDefaultPages()),
                    'is_active' => true,
                    'sort_order' => $index + 1,
                    'metadata' => json_encode([
                        'compatible_themes' => $template->getCompatibleThemes(),
                    ]),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
