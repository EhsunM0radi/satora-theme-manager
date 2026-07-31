<?php

namespace Webkul\ThemeManager\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\ThemeManager\Contracts\Template as TemplateContract;

class TemplateRepository extends Repository
{
    /**
     * Specify model class name.
     */
    public function model(): string
    {
        return TemplateContract::class;
    }

    /**
     * Get all active templates sorted by order.
     */
    public function getActiveTemplates()
    {
        return $this->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Find a template by its code.
     */
    public function findByCode(string $code)
    {
        return $this->findOneByField('code', $code);
    }

    /**
     * Get templates compatible with a given theme.
     */
    public function getCompatibleWithTheme(string $themeCode)
    {
        return $this->getActiveTemplates()->filter(function ($template) use ($themeCode) {
            return $template->isCompatibleWith($themeCode);
        });
    }
}
