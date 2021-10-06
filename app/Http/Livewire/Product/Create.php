<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $shop_id;

    protected $rules = [
        'name'          => 'required|max:50',
        'description'   => 'required|max:196'
    ];

    public function mount($shop_id){
        $this->shop_id = $shop_id;
    }

    public function render()
    {
        $categories = Category::where('shop_id',$this->shop_id)->get();
        return view('livewire.product.create', compact(['categories']))->layout('layouts.appComponent');
    }

    public function submit(){
        $this->validate();

        Product::create([
            'name'          => $this->name,
            'description'   => $this->description,
            'price'         => $this->price,
            'category_id'   => $this->category_id,
            'shop_id'       => $this->shop_id
        ]);

        return redirect('/shop');
    }
}
