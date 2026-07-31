<?php

// ── E2E Installer Wizard Flow Tests ──
// Tests the full installer view with new business preset + design selection steps

beforeEach(function () {
    config()->set('app.env', 'local');
    $this->withoutMiddleware();
});

test('installer page loads with 200', function () {
    $response = $this->get('/install');
    $response->assertOk();
});

test('installer page shows business preset step in sidebar', function () {
    $response = $this->get('/install');
    $response->assertSee('Business Type');
});

test('installer page shows design selection step in sidebar', function () {
    $response = $this->get('/install');
    // The ampersand gets HTML-encoded; assert on the rendered content
    $response->assertSee('Template');
});

test('installer page contains business preset Vue template', function () {
    $response = $this->get('/install');
    $response->assertSee("currentStep == 'businessPreset'", false);
});

test('installer page contains design selection Vue template', function () {
    $response = $this->get('/install');
    $response->assertSee("currentStep == 'designSelection'", false);
});

test('installer page includes fetchPresets Vue method', function () {
    $response = $this->get('/install');
    $response->assertSee('fetchPresets()', false);
});

test('installer page includes fetchThemes Vue method', function () {
    $response = $this->get('/install');
    $response->assertSee('fetchThemes()', false);
});

test('installer page includes fetchTemplates Vue method', function () {
    $response = $this->get('/install');
    $response->assertSee('fetchTemplates()', false);
});

test('installer Vue has presetCode data property', function () {
    $response = $this->get('/install');
    $response->assertSee('presetCode', false);
});

test('installer Vue has selectedTheme data property', function () {
    $response = $this->get('/install');
    $response->assertSee('selectedTheme', false);
});

test('installer Vue has selectedTemplate data property', function () {
    $response = $this->get('/install');
    $response->assertSee('selectedTemplate', false);
});

test('installer steps array includes businessPreset before designSelection', function () {
    $response = $this->get('/install');
    $content = $response->getContent();

    // businessPreset should appear before designSelection in steps array
    $bpPos = strpos($content, "'businessPreset'");
    $dsPos = strpos($content, "'designSelection'");
    expect($bpPos)->toBeLessThan($dsPos);
});

test('installer nextForm routes start → businessPreset', function () {
    $response = $this->get('/install');
    $content = $response->getContent();

    // Should contain the routing: start -> businessPreset
    expect($content)->toContain("'start', 'businessPreset'");
});

test('installer nextForm routes businessPreset → designSelection', function () {
    $response = $this->get('/install');
    $content = $response->getContent();

    expect($content)->toContain("'businessPreset', 'designSelection'");
});

test('installer nextForm routes designSelection → systemRequirements', function () {
    $response = $this->get('/install');
    $content = $response->getContent();

    expect($content)->toContain("'designSelection', 'systemRequirements'");
});

test('installer page loads without PHP errors', function () {
    $response = $this->get('/install');
    expect($response->status())->toBe(200);
    // No PHP error output
    expect($response->getContent())->not->toContain('Fatal error');
    expect($response->getContent())->not->toContain('Parse error');
});

test('installer shows language selector (existing step preserved)', function () {
    $response = $this->get('/install');
    $response->assertSee('Language');
    $response->assertSee('English');
});

test('installer shows system requirements (existing step preserved)', function () {
    $response = $this->get('/install');
    $response->assertSee('System Requirements');
});

test('installer shows database config (existing step preserved)', function () {
    $response = $this->get('/install');
    $response->assertSee('Database');
});
