<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Authlayout extends Component
{
  public $title;
  public function __construct($title = 'Home')
  {
    $this->title  = $title;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view('components.admin.layouts.auth-layout');
  }
}
