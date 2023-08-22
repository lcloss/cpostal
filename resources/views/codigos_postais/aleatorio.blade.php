@extends('layouts.app')
@section('content')
                    <h1 class="mt-4">Códigos Postal aleatório</h1>
                    <p>Clique no botão abaixo para gerar novo.</p>
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title">Código postal aleatório</p>
                        </div>
                        <div class="card-body">
                            <livewire:codigo-postal-aleatorio />
                        </div>
                    </div>
@endsection
