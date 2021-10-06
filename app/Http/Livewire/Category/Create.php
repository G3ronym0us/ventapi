<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Create extends Component
{

    public $name;
    public $description;
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
        return view('livewire.category.create')->layout('layouts.appComponent');
    }

    public function submit(){
        $this->validate();

        Category::create([
            'name'          => $this->name,
            'description'   => $this->description,
            'shop_id'       => $this->shop_id
        ]);

        return redirect('/shop');
    }

}
