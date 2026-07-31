<?php

namespace Webkul\ThemeManager\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\ThemeManager\Repositories\ThemeRepository;

class ThemeController extends Controller
{
    public function __construct(protected ThemeRepository $themeRepository) {}

    /**
     * Display all themes with current active highlighted.
     */
    public function index(): View
    {
        $themes = $this->themeRepository->getActiveThemes();
        $activeCode = DB::table('core_config')->where('code', 'satora.active_theme')->value('value')
            ?? config('thememanager.default_theme', 'minimal-luxury');

        return view('satora::admin.themes.index', compact('themes', 'activeCode'));
    }

    /**
     * Activate a theme.
     */
    public function activate(): RedirectResponse
    {
        $code = request()->input('code');

        DB::table('core_config')->updateOrInsert(
            ['code' => 'satora.active_theme'],
            ['value' => $code, 'channel_code' => null, 'locale_code' => null]
        );

        session()->flash('success', trans('thememanager::app.admin.theme_activated'));

        return redirect()->route('admin.satora.themes.index');
    }
}
