<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class App extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public $title;
  public $admin;
  public function __construct($title = 'Home')
  {
    $this->title = $title;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    $adminUser = Auth::guard('admin')->user();
    $setting = Setting::where('name', 'general_settings')->first();
    $general_settings = $setting->response;
    view()->share('adminUser', $adminUser);
    view()->share('general_settings', $general_settings);
    view()->share('setting', $setting);
    return view('components.admin.layouts.app');
  }
}
