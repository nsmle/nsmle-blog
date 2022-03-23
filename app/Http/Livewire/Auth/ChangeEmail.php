<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Rules\AlphaDashDot;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Auth;

class ChangeEmail extends Component
{
    public $email;
    
    public $password;
    
    public $validEmail = false;
    
    protected $rules = [
        'email' => 'required|string|email:rfc,dns|max:255|unique:users',
    ];
    
    protected $messages = [
        'email.unique' => 'email telah terdaftar.'
    ];
    
    public function changeEmail()
    {
        $email = $this->validate();
        if ($email) {
            $this->validEmail = true;
        }
    }
    
    public function changeEmailConfirm(UpdatesUserProfileInformation $updater)
    {
        $user = Auth::user()->withoutRelations()->toArray();
        if (Hash::check($this->password, Auth::user()->password)) {
            $user['email'] = $this->email;
            $updater->update(Auth::user(), $user);
            
            return redirect()->route('verification.notice')->with('status', 'Email berhasil di ganti.');
        } else {
            return $this->addError('password', 'Password yang anda masukan salah.');
        }
    }
    
    public function updated($property)
    {
        $this->validateOnly($property);
        $this->resetErrorBag('password');
    }
    
    public function mount()
    {
        if(!empty(Auth::user()->email_verified_at)) {
            redirect()->to(route('dashboard.home'));
        }
        
        $this->state = $this->state = Auth::user()->withoutRelations()->toArray();
    }
    
    public function render()
    {
        return view('livewire.auth.change-email')->layout('layouts.guest');
    }
}
