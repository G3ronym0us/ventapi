<div>
    <div class="container">
        @foreach ($shop->categories as $category)
            <button type="button" class="btn btn-sm btn-primary text-white me-3">{{ $category->name }}</button>
        @endforeach
        <hr>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Buscar" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text btn btn-primary" id="basic-addon2">Buscar</button>
        </div>

        @foreach($shop->categories as $category)
            <table class="table table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th colspan="4" class="bg-primary text-white">{{$category->name}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($category->products as $product)
                        <tr class="bg-white">
                            <td width="70px"><img src="{{ asset('storage/'.$product->photo) }}" alt="" width="50px" height="50px"></td>
                            <td scope="row">{{ $product->name }}<br>{{ $product->description }}</td>
                            <td class="text-end pe-3">$ {{ $product->price }}</td>
                            <td class="text-center fs-3 fw-bold"><button class="btn" wire:click="addCart">+</button></td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>                            
        @endforeach


    </div>
    

</div>
