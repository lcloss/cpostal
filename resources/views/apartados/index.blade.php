@extends('layouts.app')
@section('content')
                    <h1 class="mt-4">Apartados</h1>
                    <p>Pesquisa por apartados</p>
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title">Pesquisa de apartados</p>
                        </div>
                        <div class="card-body">
                            @livewire('apartado-search')
                        </div>
                    </div>
@endsection