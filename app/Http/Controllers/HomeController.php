<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Livewire\Pages\Home;
use App\Http\Livewire\Pages\Dashboard;
use Auth;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        if (Auth:: check()) {
            //return new Home\Index($request);
            new Home\Index($request);
        } else {
            return redirect()->action(Dashboard\Index::class);
            return new Dashboard\Index($request);
            return $this->indexForLoggedUser();
        }
    }
    
    public function indexForGuestUser()
    {
        
    }
    
    public function indexForLoggedUser()
    {
        
    }
}
