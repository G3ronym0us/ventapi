<?php

namespace App\Http\Livewire\User;

use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $color;
    public $phone;
    public $state;
    public $municipality;
    public $city;
    public $parish;
    public $address;
    public $logo;
    public $domain;

    public function render()
    {
        $user = Auth::user();
        $shops = $user->shops;
        return view('livewire.user.index', compact('shops'))->layout('layouts.appComponent');
    }

    public function submit(){
        $this->validate([
            'logo' => 'image|max:1024', // 1MB Max
        ]);

        $nameLogo = $this->logo->store('logos','public');

        $this->domain = strtr(strtolower($this->domain), " ", "_");

        Shop::create([
            'name'          => $this->name,
            'domain'        => $this->domain,
            'description'   => $this->description,
            'logo'          => $nameLogo,
            'color'         => $this->color,
            'phone'         => $this->phone,
            'state'         => $this->state,
            'municipality'  => $this->municipality,
            'city'          => $this->city,
            'parish'        => $this->parish,
            'address'       => $this->address,
            'user_id'       => Auth::id()
        ]);

        $this->name = '';
        $this->description = '';
        $this->color = '#563d7c';
        $this->phone = '';
        $this->state = 0;
        $this->municipality = 0;
        $this->city = '';
        $this->parish = 0;
        $this->address = '';
    }
}
