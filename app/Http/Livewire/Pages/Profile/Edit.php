<?php

namespace App\Http\Livewire\Pages\Profile;

use Livewire\Component;

use Illuminate\Http\Request;
use App\Models\User;
use Livewire\WithFileUploads;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

use Auth;

class Edit extends Component
{
    
    use WithFileUploads;
    
    public $state = [];
    
    public $photo;
    
    public $user;
    
    
    public function updatedPhoto()
    {
        $validated = $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }
    
    public function savedPhoto(UpdatesUserProfileInformation $updater)
    {
        
        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );
        
        $this->photo = null;
        
        
        $this->emit('photo-profile-saved');
    }
    
    public function save(UpdatesUserProfileInformation $updater)
    {
        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );
        
        $this->emit('profile-saved');
    }
    
    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();

        $this->emit('photo-profile-deleted');
    }
    
    public function mount(Request $request)
    {
        
        $this->state = Auth::user()->withoutRelations()->toArray();
        
        if ($request->username !== $this->state['username']) {
            abort(401);
        }
        
        
        $this->user = $this->state;
        
    }
    
    public function render()
    {
        return view('livewire.pages.profile.edit')->layout('layouts.guest');
    }
}
