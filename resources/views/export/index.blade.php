@extends('layouts.app')
@section('styles')
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
@section('content')
                    <h1 class="mt-4">Exportar Códigos Postais e Apartados</h1>
                    <p>Exportar Códigos Postais e Apartados</p>
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title">Exportar Códigos Postais e Apartados</p>
                        </div>
                        <div class="card-body">
                            @livewire('codigo-postal-export')
                            <p>
                                Os códigos postais completos podem ser obtidos no site <a href="https://www.ctt.pt/feapl_2/app/open/postalCodeSearch/postalCodeSearch.jspx?lang=def" target="_blank">CTT.pt</a>.
                            </p>
                            <p>
                                <span clasS="text-danger">Atenção:</span> este processo pode demorar alguns minutos. Por favor, não interrompa nem faça atualizar.
                            </p>
                        </div>
                    </div>
@endsection
