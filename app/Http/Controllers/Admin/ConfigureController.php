<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use App\Models\ContactUs;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigureController extends Controller
{
    public function index(){
        $setting = Setting::latest()->first();
        $aboutUs = AboutUs::latest()->first();
        $contactUs = ContactUs::latest()->first();
        $seoInfo = Setting::latest()->first();
        return view('admin.configure.index',compact('setting','aboutUs','contactUs','seoInfo'));
    }
    public function companySettingUpdate(Request $request, Setting $setting)
    {
        Setting::updateSetting($request, $setting);
        return back()->with('message', 'Record updated.');
    }
    public function aboutUsUpdate(Request $request, AboutUs $aboutUs)
    {
        AboutUs::updateAboutUs($request, $aboutUs);
        return back()->with('message', 'Info updated successfully!');
    }
    public function contactUsUpdate(Request $request, ContactUs $contactUs)
    {
        ContactUs::updateContactUs($request, $contactUs);
        return back()->with('message', 'Info updated successfully!');
    }
    public function seoInfoUpdate(Request $request,$id)
    {
        $seoInfo = Setting::find($id);
        $seoInfo->meta_title = $request->meta_title;
        $seoInfo->meta_keyword = $request->meta_keyword;
        $seoInfo->meta_author = $request->meta_author;
        $seoInfo->meta_description = $request->meta_description;
        $seoInfo->save();
        return back()->with('message', 'Info updated successfully!');
    }
}
