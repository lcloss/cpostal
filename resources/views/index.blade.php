@extends('layouts.app')
@section('content')
                    <h1 class="mt-4">Códigos Postais</h1>
                    <p>Pesquisa por códigos postais</p>
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title">Pesquisa de códigos postais</p>
                        </div>
                        <div class="card-body">
                            {{-- <div class="row mb-2">
                                <div class="col-md-12 text-end">
                                    <a class="btn btn-outline-success" href="{{ route('export') }}">Exportar</a>
                                </div>
                            </div> --}}
                            @livewire('codigo-postal-search')
                        </div>
                    </div>
@endsection