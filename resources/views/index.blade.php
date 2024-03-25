@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4>Filtros</h4>
                    <hr>

                    <form method="GET" action="{{ route('vehicles.list') }}">
                        <div class="mb-3">
                            <label for="brand" class="form-label">Marca</label>
                            <input
                                type="text"
                                class="form-control"
                                id="brand"
                                name="filter[brand]"
                                autocomplete="off"
                                value="{{ request()->filter['brand'] ?? '' }}"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="vehicle_year" class="form-label">Ano</label>
                            <input
                                type="range"
                                class="form-control-range w-100"
                                id="vehicle_year"
                                name="filter[vehicle_year]"
                                step="1"
                                min="1950"
                                max="2024"
                                value="{{ request()->filter['vehicle_year'] ?? '2024' }}"
                                oninput="document.getElementById('yearsrange').innerText = document.getElementById('vehicle_year').value"
                            /><br>
                            Até <span id="yearsrange">{{ request()->filter['vehicle_year'] ?? '2024' }}</span>
                        </div>

                        <div class="mb-3">
                            <label for="kilometers" class="form-label">KM</label>
                            <input
                                type="range"
                                class="form-control-range w-100"
                                id="kilometers"
                                name="filter[kilometers]"
                                step="1000"
                                min="0"
                                max="500000"
                                value="{{ request()->filter['kilometers'] ?? '500000' }}"
                                oninput="document.getElementById('kilometersrange').innerText = document.getElementById('kilometers').value"
                            /><br>
                            Até <span id="kilometersrange">{{ request()->filter['kilometers'] ?? '500000' }}</span>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Preço</label>
                            <input
                                type="range"
                                class="form-control-range w-100"
                                id="price"
                                name="filter[price]"
                                step="1000"
                                min="0"
                                max="500000"
                                value="{{ request()->filter['price'] ?? '500000' }}"
                                oninput="document.getElementById('pricerange').innerText = document.getElementById('price').value"
                            /><br>
                            Até <span id="pricerange">{{ request()->filter['price'] ?? '500000' }}</span>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">Cidade</label>
                            <input
                                type="text"
                                class="form-control"
                                id="city"
                                name="filter[city]"
                                autocomplete="off"
                                value="{{ request()->filter['city'] ?? '' }}"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Tipo de Veículo</label>
                            <select class="form-select" id="type" name="filter[type]">
                                <option value="">Selecione uma opção:</option>
                                <option
                                @if(isset(request()->filter['type']) && request()->filter['type'] == "Novo") selected @endif 
                                >Novo</option>
                                <option
                                @if(isset(request()->filter['type']) && request()->filter['type'] == "Usado") selected @endif 
                                >Usado</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary mb-3" type="submit">Filtrar</button>
                            <a href="{{ route('vehicles.list') }}" class="btn btn-outline-secondary mb-3">Limpar Filtros</a>
                        </div> 

                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="row row-cols-1 row-cols-md-3 g-4">

                @forelse ($items as $item)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset('assets/images/'.$item->image) }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title mb-2">{{ $item->name }}</h5>
                                <p class="card-text text-secondary mb-2">{{ $item->description }}</p>
                                <p class="card-text text-secondary mb-2">
                                    Ano {{ $item->vehicle_year }} / KM {{ $item->kilometers }} / {{ $item->type }} / {{ $item->city }}
                                </p>

                                <h5 class="mb-5">R$ {{ $item->price }}</h5>

                                <div class="actions">
                                    <button 
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#contactModal_{{ $item->id }}"
                                    >Entrar em Contato</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="contactModal_{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Contato do vendedor</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                                </div>
                                <div class="modal-body">
                                    <span><strong>Nome: </strong>{{ $item->contact_name }}</span><br>
                                    <span><strong>Telefone: </strong>{{ $item->contact_phone }}</span><br>
                                    <span><strong>E-mail: </strong>{{ $item->contact_mail }}</span><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card text-center p-3 d-flex align-items-center w-100">
                        <img src="{{ asset('assets/images/not-found.jpg')}}" alt='not-found' width="300" />
                        <h4>Nenhum veículo encontrado</h4>
                    </div>
                @endempty
            </div>
        </div>
    </div>
</div>
@endsection