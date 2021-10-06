<div>

    @switch($status)
        @case('index')
        <button class="btn btn-success" wire:click="create">Agregar Tienda</button>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>&nbsp;</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($shops) < 1)
                    <tr>
                        <td colspan="4" class="text-center">No hay tiendas registradas</td>
                    </tr>
                    @endif
                    @foreach($shops as $shop)
                    <tr>
                        <td>{{ $shop->id }}</td>
                        <td>&nbsp;</td>
                        <td>{{ $shop->name }}</td>
                        <td>{{ $shop->description }}</td>
                        <td><button class="btn btn-warning" wire:click="show({{$shop->id}})">Ver</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @break
        @case('create')
            <form wire:submit.prevent="store" method="POST">
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" wire:model="name">
                    <div id="nameHelp" class="form-text">Nombre de la Tienda</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" wire:model="description">
                    <div id="descriptionHelp" class="form-text">Nombre de la Tienda</div>
                </div>
                <button type="submit">Guardar</button>
            </form>
            @break
        @case('show')
            <h1>{{ $name }}</h1>
            <h2>{{ $description }}</h2>
            <h2>Categorias</h2>
            <ul>
                @foreach($categories as $category)
                    <li>{{ $category->name }}</li>
                @endforeach
            </ul>
            <a href="{{ url('create_category/'.$ref) }}" class="btn btn-primary">Agregar Categoria</a>
            <a href="{{ url('create_product/'.$ref) }}" class="btn btn-primary">Agregar Producto</a>
            @break;
        @default
            
    @endswitch

    
</div>

