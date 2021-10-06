<?php

namespace App\Http\Livewire\Shop;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\phacades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public $shop;
    public $categories;
    public $products;
    public $name_category;
    public $description_category;

    public $name_product;
    public $description_product;
    public $price_product;
    public $photo_product;
    public $category_id_product;

    public $new_category;

    public $varieties = array();
    public $details = array();
    public $new_variety;
    public $new_detail_name;
    public $new_detail_price;
    public $new_detail_variety;

    public function mount(Shop $shop){
        $this->shop = $shop;
    }

    public function render()
    {
        $this->categories = Category::where('shop_id',$this->shop->id)->with('products')->get();
        return view('livewire.shop.show',['categories' => $this->categories,'products' => $this->products])->layout('layouts.appComponent');
    }

    public function storeProduct(){

        $messages = [
            'name_product.required'         => 'El nombre del producto es requerido.',
            'description_product.required'  => 'La descripción del producto es requerida.',
            'price_product.required'        => 'El precio base del producto es requerido.',
            'price_product.numeric'         => 'El precio base debe ser numerico.',
            'photo_product.required'        => 'La foto del producto es requerida.',
            'photo_product.image'           => 'El archivo debe ser una imagen.',
            'photo_product.max'             => 'La foto del producto debe ser de maximo 2mb.',
            'category_id_product.required'  => 'El producto debe pertenecer a una categoria',
            'details.*.min'                 => 'Las variantes deben tener al menos dos items.'

        ];

        $this->validate([
            'name_product'          =>  'required',
            'description_product'   =>  'required',
            'price_product'         =>  'required|numeric',
            'photo_product'         =>  'required|image|max:2048',
            'category_id_product'   =>  'required',
            'details.*'             =>  'array|min:2'
        ],$messages);

        if($this->category_id_product == 'new'){
            $category = Category::create([
                'name'      => $this->new_category,
                'shop_id'   => $this->shop->id
            ]);
            $category_id = $category->id;
        }else{
            $category_id = $this->category_id_product;
        }

        $photo_product = $this->photo_product->store('photos','public');

        Product::create([
            'name'          => $this->name_product,
            'description'   => $this->description_product,
            'price'         => $this->price_product,
            'photo'         => $photo_product,
            'category_id'   => $category_id,
            'shop_id'       => $this->shop->id
        ]);

        $this->name_product = '';
        $this->description_product = '';
        $this->price_product = '';
        $this->photo_product = null;
        $this->category_id_product = '';

        $this->new_variety = '';
        $this->details = [];

        $this->new_detail_name = '';
        $this->new_detail_price = '';
        
    }

    public function addVariety(){

        $this->validate([
            'new_variety' => 'required', 
        ]);

        $this->details[$this->new_variety] = array();
        $this->new_variety = '';
    }

    public function addDetail()
    {

        $this->validate([
            'new_detail_name'       => 'required', 
            'new_detail_price'      => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 
            'new_detail_variety'    => 'required', 
        ]);

        $detail = array(
            'name' => $this->new_detail_name,
            'price' => $this->new_detail_price
        );

        array_push($this->details[$this->new_detail_variety], $detail);
        
        $this->new_detail_name = '';
        $this->new_detail_price = '';
        
    }

    public function deleteDetail($variety, $index)
    {
        unset($this->details[$variety][$index]);
    }

    public function deleteVariety($name)
    {
        unset($this->details[$name]);
    }
}
