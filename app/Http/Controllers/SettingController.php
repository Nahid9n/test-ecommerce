<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\ContactUs;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index',[
            'setting' => Setting::latest()->first(),
        ]);
    }
    public function update(Request $request, Setting $setting)
    {
        Setting::updateSetting($request, $setting);
        return back()->with('message', 'Record updated.');
    }
}
