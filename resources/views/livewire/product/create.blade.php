<div>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <a href="{{ url('shop') }}" class="btn btn-primary">Mis Tiendas</a>
                        <br>
                        <form wire:submit.prevent="submit" method="POST">
                            <div class="mb-3">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" wire:model="name">
                                <div id="nameHelp" class="form-text">Nombre de la Categoria</div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" wire:model="description">
                                <div id="descriptionHelp" class="form-text">Nombre de la Categoria</div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="description" name="price" wire:model="price">
                                <div id="descriptionHelp" class="form-text">Nombre de la Categoria</div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Categoria</label>
                                <select name="" id="" wire:model="category_id" class="form-select">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div id="descriptionHelp" class="form-text">Nombre de la Categoria</div>
                            </div>
                            <button type="submit">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
