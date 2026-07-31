<?php

namespace Webkul\ThemeManager\Themes;

use Webkul\ThemeManager\Contracts\Theme as ThemeContract;

abstract class AbstractTheme implements ThemeContract
{
    protected string $code;

    protected string $name;

    protected ?string $description = null;

    protected array $colors = [];

    protected array $typography = [];

    protected array $compatibleTemplates = [];

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

    public function getColors(): array
    {
        return $this->colors;
    }

    public function getTypography(): array
    {
        return $this->typography;
    }

    public function getCssVariables(): string
    {
        $vars = [];

        foreach ($this->colors as $key => $value) {
            $vars[] = "--color-{$key}: {$value};";
        }

        foreach ($this->typography as $key => $value) {
            $vars[] = "--font-{$key}: {$value};";
        }

        return implode("\n", $vars);
    }

    public function getCompatibleTemplates(): array
    {
        return $this->compatibleTemplates;
    }

    public function isCompatibleWith(string $templateCode): bool
    {
        if (empty($this->compatibleTemplates) || in_array('*', $this->compatibleTemplates)) {
            return true;
        }

        return in_array($templateCode, $this->compatibleTemplates);
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'preview_image' => $this->previewImage,
            'colors' => $this->colors,
            'typography' => $this->typography,
            'compatible_templates' => $this->compatibleTemplates,
        ];
    }
}
