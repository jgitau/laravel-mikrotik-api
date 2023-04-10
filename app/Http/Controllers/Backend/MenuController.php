<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function getMenu()
    {
        $admin = Admin::find(session('id'));
        $modules = $admin->modules()->where('root', 0)->where('active', 1)->orderBy('name')->get();
        $menuHtml = $this->generateMenuHtml($modules);
        return view('layouts.sections.menu.verticalMenu', [
            'menuHtml' => $menuHtml,
        ]);
    }
    private function generateMenuHtml($modules)
    {
        $html = '';

        foreach ($modules as $module) {
            $activeClass = (request()->routeIs($module->slug)) ? 'active' : '';

            if ($module->pages->isEmpty()) {
                $html .= '<li class="menu-item ' . $activeClass . '">';
                $html .= '<a href="' . $module->url . '" class="menu-link">';
                $html .= '<i class="' . $module->icon . '"></i>';
                $html .= '<div>' . $module->name . '</div>';
                $html .= '</a></li>';
            } else {
                $html .= '<li class="menu-item ' . $activeClass . '">';
                $html .= '<a href="#" class="menu-link menu-toggle">';
                $html .= '<i class="' . $module->icon . '"></i>';
                $html .= '<div>' . $module->name . '</div>';
                $html .= '</a><ul class="menu-inner">' . $this->generateMenuHtml($module->pages) . '</ul></li>';
            }
        }

        return $html;
    }

}
