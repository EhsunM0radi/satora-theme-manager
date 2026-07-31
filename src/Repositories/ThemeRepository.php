<?php

namespace Webkul\ThemeManager\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\ThemeManager\Contracts\Theme as ThemeContract;

class ThemeRepository extends Repository
{
    /**
     * Specify model class name.
     */
    public function model(): string
    {
        return ThemeContract::class;
    }

    /**
     * Get all active themes sorted by order.
     */
    public function getActiveThemes()
    {
        return $this->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Find a theme by its code.
     */
    public function findByCode(string $code)
    {
        return $this->findOneByField('code', $code);
    }

    /**
     * Get themes compatible with a given template.
     */
    public function getCompatibleWithTemplate(string $templateCode)
    {
        return $this->getActiveThemes()->filter(function ($theme) use ($templateCode) {
            return $theme->isCompatibleWith($templateCode);
        });
    }
}
