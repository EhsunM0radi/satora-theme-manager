<?php

namespace Webkul\ThemeManager\Contracts;

interface Theme
{
    /**
     * Get the theme code.
     */
    public function getCode(): string;

    /**
     * Get the theme name.
     */
    public function getName(): string;

    /**
     * Get the theme description.
     */
    public function getDescription(): ?string;

    /**
     * Get the preview image path.
     */
    public function getPreviewImage(): ?string;

    /**
     * Get theme colors configuration.
     */
    public function getColors(): array;

    /**
     * Get theme typography configuration.
     */
    public function getTypography(): array;

    /**
     * Get theme CSS variables.
     */
    public function getCssVariables(): string;

    /**
     * Get compatible templates for this theme.
     */
    public function getCompatibleTemplates(): array;

    /**
     * Check if theme is compatible with a given template.
     */
    public function isCompatibleWith(string $templateCode): bool;

    /**
     * Get the theme configuration as array.
     */
    public function toArray(): array;
}
