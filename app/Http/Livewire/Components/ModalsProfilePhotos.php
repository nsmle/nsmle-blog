<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalsProfilePhotos extends ModalComponent
{
    public $profilePhoto;
    
    public function mount($profilePhoto)
    {
        $this->profilePhoto = $profilePhoto;
    }
    
    public function render()
    {
        return view('livewire.components.modals-profile-photos', [
            'profilePhoto'
        ]);
    }
}
