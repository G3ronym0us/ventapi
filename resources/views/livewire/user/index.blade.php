<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fas fa-shopping-bag"></i>&nbsp;Nueva Tienda</div>
                <div class="card-body">
                    <form wire:submit.prevent="submit" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" wire:model="name">
                                <div id="nameHelp" class="form-text"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Dominio</label>
                                <input type="text" class="form-control mb-1" id="domain" name="domain" wire:model="domain">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="description" name="description" wire:model="description">
                                <div id="descriptionHelp" class="form-text"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Logo</label>
                                <input class="form-control" type="file" id="logo" name="logo" wire:model="logo">
                                @error('logo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="" class="form-label">Color</label>
                                <input type="color" class="form-control form-control-color" id="color-select" name="color-select" wire:model="color" value="#563d7c" title="Selecciona un color">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Telefono</label>
                                <input type="tel" class="form-control" id="phone" name="phone" wire:model="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Estado</label>
                                <select class="form-select" id="state-select" name="state-select" wire:ignore></select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Municipio</label>
                                <select class="form-select" id="municipality-select" name="municipality-select" wire:ignore></select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="city" name="city" wire:model="city">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Parroquia</label>
                                <select class="form-select" id="parish-select" name="parish-select" wire:ignore></select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="address" name="address" wire:model="address">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-success form-control" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">Tiendas</div>
                <div class="card-body">
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
                                <td><a href="{{ url('show_shop/'.$shop->id) }}" class="btn btn-warning">Ver</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
        $(document).ready(function(){
            var venezuela;

            $.getJSON("{{ asset('js/venezuela.json') }}", async function(response) {
                venezuela = response;
                await response.forEach( (element, index) => {
                    $('#state-select').append('<option value="'+index+'">'+element.estado+'</option>');
                });

                changeMunicipality();
                changeParish();
                @this.set('parish', $('#parish-select').val());

            });

            $('#state-select').on('change',function(){

                changeMunicipality();
                changeParish();
                @this.set('parish', $('#parish-select').val());

            })

            $('#municipality-select').on('change',function(){
                changeParish();
                @this.set('parish', $('#parish-select').val());
            });

            $('#parish-select').on('change',function(){
                @this.set('parish', $('#parish-select').val());
            });

            $('#color-select').on('change',function(){
                console.log($('#color-select').val());
                $('#color').val($('#color-select').val());
            });

            function changeMunicipality(){
                @this.set('state', venezuela[$('#state-select').val()].estado);
                $('#municipality-select').html('');
                state_id = $('#state-select').val();
                state = venezuela[state_id];
                state.municipios.forEach((element, index) => {
                    $('#municipality-select').append('<option value="'+index+'">'+element.municipio+'</option>');
                });
            }

            function changeParish(){
                @this.set('municipality', venezuela[$('#state-select').val()].municipios[$('#municipality-select').val()].municipio);
                $('#parish-select').html('');
                municipality_id = $('#municipality-select').val();
                state_id = $('#state-select').val();
                municipality = venezuela[state_id].municipios[municipality_id];
                municipality.parroquias.forEach((element, index) => {
                    $('#parish-select').append('<option>'+element+'</option>');
                });
            }

        })
    </script>
    @endpush
</div>
