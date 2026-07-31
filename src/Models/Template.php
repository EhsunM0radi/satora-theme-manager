<?php

namespace Webkul\ThemeManager\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\ThemeManager\Contracts\Template as TemplateContract;
use Webkul\ThemeManager\Contracts\TemplateModel;

class Template extends Model implements TemplateContract, TemplateModel
{
    /**
     * The table associated with the model.
     */
    protected $table = 'satora_templates';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'preview_image',
        'sections',
        'navigation',
        'homepage_layout',
        'default_pages',
        'is_active',
        'sort_order',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'sections' => 'array',
        'navigation' => 'array',
        'homepage_layout' => 'array',
        'default_pages' => 'array',
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the template code.
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Get the template name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the template description.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get the preview image path.
     */
    public function getPreviewImage(): ?string
    {
        return $this->preview_image;
    }

    /**
     * Get the layout sections configuration.
     */
    public function getSections(): array
    {
        return $this->sections ?? [];
    }

    /**
     * Get the navigation structure.
     */
    public function getNavigation(): array
    {
        return $this->navigation ?? [];
    }

    /**
     * Get the homepage layout definition.
     */
    public function getHomepageLayout(): array
    {
        return $this->homepage_layout ?? [];
    }

    /**
     * Get the default pages to create.
     */
    public function getDefaultPages(): array
    {
        return $this->default_pages ?? [];
    }

    /**
     * Get compatible themes for this template.
     */
    public function getCompatibleThemes(): array
    {
        return $this->metadata['compatible_themes'] ?? [];
    }

    /**
     * Check if template is compatible with a given theme.
     */
    public function isCompatibleWith(string $themeCode): bool
    {
        $compatible = $this->getCompatibleThemes();

        if (empty($compatible) || in_array('*', $compatible)) {
            return true;
        }

        return in_array($themeCode, $compatible);
    }

    /**
     * Get the template configuration as array.
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'preview_image' => $this->preview_image,
            'sections' => $this->sections,
            'navigation' => $this->navigation,
            'homepage_layout' => $this->homepage_layout,
            'default_pages' => $this->default_pages,
            'is_active' => $this->is_active,
            'metadata' => $this->metadata,
        ];
    }
}
