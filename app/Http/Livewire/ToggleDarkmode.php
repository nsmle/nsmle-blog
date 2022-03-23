<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ToggleDarkmode extends Component
{
    public $darkmodeIcon = "";
    
    protected $listeners = ['changeTheme' => 'changeTheme'];
    
    public function changeTheme($themeIcon)
    {
        $this->darkmodeIcon = $themeIcon;
    }
    
    public function render()
    {
        return view('livewire.toggle-darkmode', [
            'darkmodeIcon',
        ]);
    }
    
}
