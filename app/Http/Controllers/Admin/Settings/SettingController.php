<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use FileUploader;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  //

  public function showSettingPage()
  {
    $this->data['title'] = 'Settings';
    return $this->view('admin.settings.sitesetting');
  }

  public function index()
  {
    $this->data['title'] = 'Setting';
    $this->data['setting'] = Setting::where('name', 'general_settings')->first();
    return $this->view('admin.settings.setting');
  }

  public function store(Request $request)
  {

    $setting = Setting::where('name', 'general_settings')->first();
    $setting = $setting->response;

    $data = $request->all();
    unset($data['_token']);

    $data['logo'] = FileUploader::make($request->logo)->upload('setting', $setting->logo ?? null);
    $data['favicon'] = FileUploader::make($request->favicon)->upload('setting', $setting->favicon ?? null);


    $json = json_encode($data);

    Setting::updateOrCreate([
      'name' => 'general_settings'
    ], [
      'name' => 'general_settings',
      'response' => $json
    ]);


    return back()->with('success', 'Setting updated successfully');
  }
}
