<?php

namespace Webkul\ThemeManager\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\ThemeManager\Contracts\Theme as ThemeContract;
use Webkul\ThemeManager\Contracts\ThemeModel;

class Theme extends Model implements ThemeContract, ThemeModel
{
    /**
     * The table associated with the model.
     */
    protected $table = 'satora_themes';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'preview_image',
        'colors',
        'typography',
        'is_active',
        'sort_order',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'colors' => 'array',
        'typography' => 'array',
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the theme code.
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Get the theme name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the theme description.
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
     * Get theme colors configuration.
     */
    public function getColors(): array
    {
        return $this->colors ?? [];
    }

    /**
     * Get theme typography configuration.
     */
    public function getTypography(): array
    {
        return $this->typography ?? [];
    }

    /**
     * Get theme CSS variables as a style block.
     */
    public function getCssVariables(): string
    {
        $colors = $this->getColors();
        $typography = $this->getTypography();

        $vars = [];

        foreach ($colors as $key => $value) {
            $vars[] = "--color-{$key}: {$value};";
        }

        foreach ($typography as $key => $value) {
            $vars[] = "--font-{$key}: {$value};";
        }

        return implode("\n", $vars);
    }

    /**
     * Get compatible templates for this theme.
     */
    public function getCompatibleTemplates(): array
    {
        return $this->metadata['compatible_templates'] ?? [];
    }

    /**
     * Check if theme is compatible with a given template.
     */
    public function isCompatibleWith(string $templateCode): bool
    {
        $compatible = $this->getCompatibleTemplates();

        if (empty($compatible) || in_array('*', $compatible)) {
            return true;
        }

        return in_array($templateCode, $compatible);
    }

    /**
     * Get the theme configuration as array.
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'preview_image' => $this->preview_image,
            'colors' => $this->colors,
            'typography' => $this->typography,
            'is_active' => $this->is_active,
            'metadata' => $this->metadata,
        ];
    }
}
