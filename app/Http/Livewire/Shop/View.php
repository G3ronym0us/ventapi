<?php

namespace App\Http\Livewire\Shop;

use App\Models\Shop;
use Darryldecode\Cart\Facades\CartFacade;
use Livewire\Component;

class View extends Component
{
    public $name;
    public $description;
    public $shop;

    public function mount($name){
        $this->name = $name;
        $this->shop = Shop::where('domain', $name)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.shop.view')->layout('layouts.appFront',['name' => $this->name]);
    }

    public function addCart(){
        CartFacade::add(456, 'Sample Item', 100.99, 2, array());
    }
    
}
