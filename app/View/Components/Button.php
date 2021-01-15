<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
  public $icon = null;
  public $variant = 'button';
  public function __construct($icon = null, $variant = 'button')
  {
    $this->variant = $variant;
    $this->icon = $icon;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    if ($this->variant == 'link') {
      return view('components.admin.UI.button-link');
    }
    return view('components.admin.UI.button');
  }
}
