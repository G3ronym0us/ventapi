<div>
    <div class="card">
        <div class="card-header">Mis Tiendas</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($shops as $shop)
                <li class="list-group-item list-group-item-action">{{ $shop->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

