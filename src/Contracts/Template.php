<?php

namespace Webkul\ThemeManager\Contracts;

interface Template
{
    /**
     * Get the template code.
     */
    public function getCode(): string;

    /**
     * Get the template name.
     */
    public function getName(): string;

    /**
     * Get the template description.
     */
    public function getDescription(): ?string;

    /**
     * Get the preview image path.
     */
    public function getPreviewImage(): ?string;

    /**
     * Get the layout sections configuration.
     */
    public function getSections(): array;

    /**
     * Get the navigation structure.
     */
    public function getNavigation(): array;

    /**
     * Get the homepage layout definition.
     */
    public function getHomepageLayout(): array;

    /**
     * Get the default pages to create.
     */
    public function getDefaultPages(): array;

    /**
     * Get compatible themes for this template.
     */
    public function getCompatibleThemes(): array;

    /**
     * Check if template is compatible with a given theme.
     */
    public function isCompatibleWith(string $themeCode): bool;

    /**
     * Get the template configuration as array.
     */
    public function toArray(): array;
}
