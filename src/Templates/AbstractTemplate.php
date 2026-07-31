<?php

namespace Webkul\ThemeManager\Templates;

use Webkul\ThemeManager\Contracts\Template as TemplateContract;

abstract class AbstractTemplate implements TemplateContract
{
    protected string $code;

    protected string $name;

    protected ?string $description = null;

    protected array $sections = [];

    protected array $navigation = [];

    protected array $homepageLayout = [];

    protected array $defaultPages = [];

    protected array $compatibleThemes = [];

    protected ?string $previewImage = null;

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPreviewImage(): ?string
    {
        return $this->previewImage;
    }

    public function getSections(): array
    {
        return $this->sections;
    }

    public function getNavigation(): array
    {
        return $this->navigation;
    }

    public function getHomepageLayout(): array
    {
        return $this->homepageLayout;
    }

    public function getDefaultPages(): array
    {
        return $this->defaultPages;
    }

    public function getCompatibleThemes(): array
    {
        return $this->compatibleThemes;
    }

    public function isCompatibleWith(string $themeCode): bool
    {
        if (empty($this->compatibleThemes) || in_array('*', $this->compatibleThemes)) {
            return true;
        }

        return in_array($themeCode, $this->compatibleThemes);
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'preview_image' => $this->previewImage,
            'sections' => $this->sections,
            'navigation' => $this->navigation,
            'homepage_layout' => $this->homepageLayout,
            'default_pages' => $this->defaultPages,
            'compatible_themes' => $this->compatibleThemes,
        ];
    }
}
