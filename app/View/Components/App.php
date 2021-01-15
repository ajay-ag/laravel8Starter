<?php

namespace App\View\Components;

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
    view()->share('adminUser', $adminUser);
    return view('components.admin.layouts.app');
  }
}
