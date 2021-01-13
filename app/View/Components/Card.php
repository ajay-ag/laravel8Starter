<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
  public $header;
  public $padding;
  public function __construct($header = NULL, $padding = NULL)
  {
    $this->header = $header;
    $this->padding = $padding;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view('components.admin.UI.card');
  }
}
