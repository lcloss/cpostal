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
                        <div class="card-body" x-data="{ tipo: 'codigos_postais' }">
                            <form action="{{ route('export.run') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select name="tipo" id="tipo" class="form-control" x-model="tipo">
                                            <option value="codigos_postais">Códigos Postais</option>
                                            <option value="apartados">Apartados</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="formato" class="form-label">Formato</label>
                                        <select name="formato" id="formato" class="form-control">
                                            <option value="csv">CSV</option>
                                            <option value="xlsx">XLSX</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" x-show="tipo == 'codigos_postais'">
                                        <label for="distrito" class="form-label">Distrito</label>
                                        <select name="distrito" id="distrito" class="form-control">
                                            <option value="">Todos os Distritos</option>
                                            @foreach( $distritos as $distrito )
                                                <option value="{{ $distrito->id }}">{{ $distrito->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Exportar</button>
                                    </div>
                                </div>
                            </form>
                            <p>
                                Os códigos postais completos podem ser obtidos no site <a href="https://www.ctt.pt/feapl_2/app/open/postalCodeSearch/postalCodeSearch.jspx?lang=def" target="_blank">CTT.pt</a>.
                            </p>
                            <p>
                                <span clasS="text-danger">Atenção:</span> este processo pode demorar alguns minutos. Por favor, não interrompa nem faça atualizar.
                            </p>
                        </div>
                    </div>
@endsection
