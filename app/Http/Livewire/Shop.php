<?php

namespace App\Http\Livewire;

use App\Models\Shop as ModelsShop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Shop extends Component
{

    public $ref;
    public $name;
    public $description;
    public $logo = 'prueba';
    public $status = 'index';
    public $categories = null;

    protected $rules = [
        'name'          => 'required|max:50',
        'description'   => 'required|max:196'
    ];

    public function render()
    {
        $user = Auth::user();
        $shops = $user->shops;
        $status = $this->status;
        return view('livewire.shop', compact('shops','status'));
    }

    public function create(){
        $this->status = 'create';
    }

    public function store(){
        $this->validate();

        ModelsShop::create([
            'name'          => $this->name,
            'description'   => $this->description,
            'logo'          => $this->logo,
            'user_id'       => Auth::id()
        ]);

        $this->status = 'index';
    }

    public function show(ModelsShop $shop){
        $this->ref = $shop->id;
        $this->name = $shop->name;
        $this->description = $shop->description;
        $this->status = 'show';
        $this->categories = $shop->categories;
    }
}
