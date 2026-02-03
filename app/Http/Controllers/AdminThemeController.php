<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class AdminThemeController extends Controller
{
    public function toggle(Request $request)
    {
        $theme = $request->input('theme') === 'dark' ? 'dark' : 'light';
        Setting::updateOrCreate(['key' => 'admin_theme'], ['value' => $theme]);
        return response()->json(['ok' => true, 'theme' => $theme]);
    }
}
