<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ButtonSecondaryLink extends Component
{
    public $text, $href, $class;
    
    protected $listeners = [
        'click' => 'click'
    ];
    
    public function click()
    {
        return redirect()->to($this->href);
    }
    
    public function mount($text, $href=null, $class=null)
    {
        $this->text = $text;
        if (!empty($href)) {
            $this->href = $href;
        }
        if (!empty($class)) {
            $this->class = $class;
        }
    }
    
    public function render()
    {
        return view('livewire.components.button-secondary-link', [
            'text' => $this->text,
            'href' => $this->href,
            'class' => $this->class
        ]);
    }
}
