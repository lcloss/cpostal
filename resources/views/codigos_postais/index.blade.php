@extends('layouts.app')
@section('content')
                    <h1 class="mt-4">Códigos Postais e Apartados</h1>
                    <p>Pesquisa por códigos postais e apartados</p>
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title">Pesquisa de códigos postais e apartados</p>
                        </div>
                        <div class="card-body">
                            @livewire('codigos-postais-search')
                        </div>
                    </div>
@endsection
