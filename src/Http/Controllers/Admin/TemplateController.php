<?php

namespace Webkul\ThemeManager\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\ThemeManager\Repositories\TemplateRepository;

class TemplateController extends Controller
{
    public function __construct(protected TemplateRepository $templateRepository) {}

    /**
     * Display all templates with current active highlighted.
     */
    public function index(): View
    {
        $templates = $this->templateRepository->getActiveTemplates();
        $activeCode = DB::table('core_config')->where('code', 'satora.active_template')->value('value')
            ?? config('thememanager.default_template', 'general');

        return view('satora::admin.templates.index', compact('templates', 'activeCode'));
    }

    /**
     * Activate a template.
     */
    public function activate(): RedirectResponse
    {
        $code = request()->input('code');

        DB::table('core_config')->updateOrInsert(
            ['code' => 'satora.active_template'],
            ['value' => $code, 'channel_code' => null, 'locale_code' => null]
        );

        session()->flash('success', trans('thememanager::app.admin.template_activated'));

        return redirect()->route('admin.satora.templates.index');
    }
}
