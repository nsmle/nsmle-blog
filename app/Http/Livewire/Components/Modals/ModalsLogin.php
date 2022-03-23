<?php

namespace App\Http\Livewire\Components\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use Auth;

class ModalsLogin extends ModalComponent
{
    public $user;
    
    public $username;
    
    public $password;
    
    public $remember;
    
    public $message;
    public $redirectAfterLogin;
    
    public function updatedUsername()
    {
        $user = User::where('username', $this->username)->first();
        if (!$user) {
            $this->addError('username', "Pengguna tidak ditemukan.");
        } else {
            $this->resetErrorBag('username');
        }
    }
    
    public function updatedPassword()
    {
        $this->resetErrorBag('password');
    }
    
    public function authenticate()
    {
        $credentials = [
            'username' => $this->username,
            'password' => $this->password
        ];
        
        
        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            
            return redirect()->to($this->redirectAfterLogin);
        }
        
        $this->addError('password', "Password/Kata sandi salah.");
    }
    
    public function mount($redirectAfterLogin, $message = null)
    {
        $this->redirectAfterLogin = $redirectAfterLogin;
        $this->message = $message;
    }
    
    public function render()
    {
        return view('livewire.components.modals.modals-login', [
            'message' => $this->message
        ]);
    }
}
