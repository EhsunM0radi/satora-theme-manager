<?php

use Webkul\ThemeManager\Database\Seeders\ThemeAndTemplateSeeder;
use Webkul\User\Models\Admin;

// ── Admin Theme + Template Controller Integration ──
// Tests POST behavior (config writes) — the real integration surface.
// View rendering requires deeper admin theme wiring; tested manually.

beforeEach(function () {
    $this->seed(ThemeAndTemplateSeeder::class);
    $admin = Admin::first() ?? Admin::factory()->create();
    $this->actingAs($admin, 'admin');
});

test('POST activate theme writes config and redirects', function () {
    $response = $this->post('/admin/satora/themes/activate', ['code' => 'modern-dark']);
    $response->assertRedirect();

    $stored = DB::table('core_config')->where('code', 'satora.active_theme')->first();
    expect($stored)->not->toBeNull();
    expect($stored->value)->toBe('modern-dark');
});

test('POST activate theme shows success flash', function () {
    $response = $this->post('/admin/satora/themes/activate', ['code' => 'colorful']);
    $response->assertSessionHas('success');
});

test('POST activate template writes config and redirects', function () {
    $response = $this->post('/admin/satora/templates/activate', ['code' => 'fashion']);
    $response->assertRedirect();

    $stored = DB::table('core_config')->where('code', 'satora.active_template')->first();
    expect($stored)->not->toBeNull();
    expect($stored->value)->toBe('fashion');
});

test('POST activate template persists across requests', function () {
    $this->post('/admin/satora/templates/activate', ['code' => 'grocery']);

    $stored = DB::table('core_config')->where('code', 'satora.active_template')->first();
    expect($stored->value)->toBe('grocery');

    // Change to another
    $this->post('/admin/satora/templates/activate', ['code' => 'general']);

    $stored = DB::table('core_config')->where('code', 'satora.active_template')->first();
    expect($stored->value)->toBe('general');
});

test('theme activation is idempotent', function () {
    // Activate twice with same code
    $this->post('/admin/satora/themes/activate', ['code' => 'minimal-luxury']);
    $this->post('/admin/satora/themes/activate', ['code' => 'minimal-luxury']);

    // Should only have one config row (updateOrInsert)
    $count = DB::table('core_config')->where('code', 'satora.active_theme')->count();
    expect($count)->toBe(1);
});
