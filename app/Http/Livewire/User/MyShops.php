<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyShops extends Component
{
    public function render()
    {
        $user = Auth::user();
        $shops = $user->shops;
        return view('livewire.user.my-shops', compact(['shops']));
    }
}
