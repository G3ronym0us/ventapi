<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ asset('storage/'.$shop->logo) }}" class="img-fluid"></a>
                </div>
                <div class="col-md-10">
                    <hr style="background-color: {{$shop->color}}; height:10px;">
                    <h2>{{ $shop->name }}</h2>
                    <h4>{{ $shop->description }}</h4>
                </div>
            </div></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-6">
                    <div>
                        @foreach($categories as $category)
                            <table class="table table-inverse table-responsive">
                                <thead class="thead-inverse">
                                    <tr style="background-color: {{$shop->color}};color: #FFFFFF;">
                                        <th colspan="4">{{$category->name}}</th>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category->products as $product)
                                        <tr>
                                            <td><img src="{{ asset('storage/'.$product->photo) }}" alt="" style="width: 50px; height:50px;"></td>
                                            <td class="align-middle" scope="row">{{ $product->name }}</td>
                                            <td class="align-middle">{{ $product->description }}</td>
                                            <td class="align-middle">$ {{ $product->price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>                            
                        @endforeach
                    </div>
                </div>
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">Agregar Producto</div>
                        <div class="card-body">
                            <form wire:submit.prevent="storeProduct">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" wire:model="name_product">
                                        @error('name_product') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="" class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" wire:model="description_product">
                                        <div id="descriptionHelp" class="form-text">Descripción de la Categoria</div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="" class="form-label">Precio</label>
                                        <input type="text" class="form-control" id="price" name="price" wire:model="price_product">
                                        <div id="priceHelp" class="form-text">Descripción de la Categoria</div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="" class="form-label">Foto</label>
                                        <input class="form-control" type="file" id="photo_product" name="photo_product" wire:model="photo_product">
                                        @error('photo_product') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="" class="form-label">Categoria</label>
                                        <select name="category_id_product" id="category_id_product" wire:model="category_id_product" class="form-select">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            <option value="new">Nueva Categoria</option>
                                        </select>
                                        @if($category_id_product == 'new' || count($categories) < 1)
                                        <input type="text" name="new_category" id="new_category" wire:model="new_category" class="form-control mt-2" placeholder="Nombre de Nueva Categoria">
                                        @endif
                                    </div>
    
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Agregar Variedad" aria-label="Recipient's username" aria-describedby="button-addon2" wire:model="new_variety">
                                        <button class="btn btn-success" type="button" id="button-addon2" wire:click="addVariety">Agregar</button>
                                    </div>
                                    @error('new_variety') <span class="text-danger">{{ $message }}</span> @enderror

                                    <div class="col-md-12 mb-3">
                                        Agregar Detalles
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Nombre" wire:model="new_detail_name">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Precio" wire:model="new_detail_price">
                                            @error('new_detail_price') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="" id="" wire:model="new_detail_variety">
                                                <option value="null" disabled selected class="text-center"> ----- </option>
                                                @foreach($details as $name => $variety)
                                                    <option value="{{ $name }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                   
                                    
                                    <div class="col-md-1 mb-3">
                                        <button class="btn btn-success" wire:click="addDetail">+</button>
                                    </div>

                                    @foreach($details as $name => $variety)
                                        <table class="table table-striped table-inverse table-responsive">
                                            <thead class="thead-inverse">
                                                <tr class="bg-primary">
                                                    <th colspan="3">{{ $name }}&nbsp;<i class="fas fa-trash-alt text-danger" wire:click="deleteVariety('{{ $name }}')"></i></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($variety) > 0)
                                                        @foreach($variety as $index => $detail)
                                                            <tr>
                                                                <td>{{ $detail['name'] }}</td>
                                                                <td>{{ $detail['price'] }}</td>
                                                                <td><button class="btn btn-danger" wire:click="deleteDetail('{{ $name }}',{{ $index}})">Eliminar</button></td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="3" class="text-center">Sin Detalles</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                        </table>
                                    @endforeach

                                    
                                    @error('details.*') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
        </div>
    </div>
</div>
