<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:settings', ['only' => ['index', 'edit', 'modify']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('settings.show', compact('setting'));
    }


    public function edit()
    {
        $setting = Setting::first();
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        request()->validate([
            'app_name' => 'required',
            'app_title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'app_email' => 'required|email',
            'app_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();

        if ($request->hasFile('app_logo')) {
            $path = public_path('uploads/');
            if ($setting->app_logo) {
                if (File::exists($path . $setting->app_logo)) {
                    File::delete($path . $setting->app_logo);
                }
            }
            $imageName = 'logo.' . $request->app_logo->extension();
            $request->app_logo->move($path, $imageName);
            $input['app_logo'] = $imageName;
        }

        if ($request->hasFile('app_fav')) {
            $path = public_path('uploads/');
            if ($setting->app_fav) {
                if (File::exists($path . $setting->app_fav)) {
                    File::delete($path . $setting->app_fav);
                }
            }
            $imageName = 'fav.' . $request->app_fav->extension();
            $request->app_fav->move($path, $imageName);
            $input['app_fav'] = $imageName;
        }
        if ($request->is_ad_login) {
            $input['is_ad_login'] = 1;
        } else {
            $input['is_ad_login'] = 0;
        }
        $setting->update($input);
        Artisan::call('cache:clear');


        return redirect()->route('settings.index')
            ->with('success', 'Setting updated successfully');
    }
    public function ad_active_check(Request $request)
    {
        $LDAP_USERNAME = config('ldap.connections.default.settings.username');;
        // dd($LDAP_USERNAME);
        if ($LDAP_USERNAME && $LDAP_USERNAME != 'username') {
            try {
                Artisan::call('adldap:import', [
                    '--no-interaction',
                    '--filter' => "(userprincipalname=" . $LDAP_USERNAME . ")",
                ]);
                $data['message'] = "Active Directory(AD) Connection Successful, You Can Update.";
                $data['status'] = 1;
                return $data;
            } catch (\Throwable $th) {
                $data['message'] = "Please Check Your Active Directory Connection(AD/LDAP)";
                $data['status'] = 0;
                return $data;
            }
        }
        $data['message'] = "Please Check Your Active Directory Connection(AD/LDAP)";
        $data['status'] = 0;
        return $data;
    }
}
