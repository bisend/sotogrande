<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Support\Facades\Artisan;

class AdminSiteSettingsController extends Controller
{
    public function index(){
        $timezonelist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        return view('admin.settings.site_settings', compact('timezonelist'));
    }

    // Inserting the keys
    public function insert(Request $request){
        if($request->logo){
            $file = $request->file('logo');
            if(isset($file) && $file->isValid()){
                $setting = Setting::where([['type', 'site'],['key', 'site_logo']])->first();
                if(File::exists(public_path().'/assets/images/home/'.'logo.png')){
                    File::delete(public_path().'/assets/images/home/'.'logo.png');
                }
                if(File::exists(public_path().'/assets/images/home/'.'logo.jpg')){
                    File::delete(public_path().'/assets/images/home/'.'logo.jpg');
                }
                if(File::exists(public_path().'/assets/images/home/'.'logo.jpeg')){
                    File::delete(public_path().'/assets/images/home/'.'logo.jpeg');
                }
                $name = 'logo.' . $file->getClientOriginalExtension();
                $img = Image::make($file->getRealPath());
                $img->save(public_path().'/assets/images/home/'. $name);
                $setting->value = $name;
                $setting->save();
            }
        }

        if($request->favicon){
            $file = $request->file('favicon');
            if(isset($file) && $file->isValid()){
                $name = 'favicon.ico';
                File::move($file->getRealPath(), public_path() . '/' . $name);
            }
        }

        $settings = Setting::where('type', 'site')->get();
        $arr = [
            'site_logo'
        ];
        foreach($settings as $setting){
            $key = $setting->key;
            $setting->value = $request->$key;
            if ( ! in_array($key, $arr)) {
                $setting->save();
            }
        }
        return redirect()->back();

    }
}
