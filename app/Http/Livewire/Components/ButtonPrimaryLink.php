<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ButtonPrimaryLink extends Component
{
    public $text, $href, $redirected;
    
    protected $listeners = [
        'click' => 'click'
    ];
    
    public function click()
    {
        if ($this->redirected) {
            return redirect()->to($this->href);
        }
    }
    
    public function mount($text, $href=null)
    {
        $this->text = $text;
        $this->href = $href;
    }
    
    public function render()
    {
        return view('livewire.components.button-primary-link', [
            'text' => $this->text,
            'href' => $this->href
        ]);
    }
}
