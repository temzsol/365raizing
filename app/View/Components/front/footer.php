<?php

namespace App\View\Components\front;

use Illuminate\View\Component;
use App\Models\Websitesetting;

class footer extends Component
{
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setting=Websitesetting::find(1);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        $setting=Websitesetting::find(1);
        return view('components.front.footer',compact('setting'));
    }
}
