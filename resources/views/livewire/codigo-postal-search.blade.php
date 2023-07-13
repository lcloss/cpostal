<div>
                            <form action="{{ route('search') }}" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-2 form-group">
                                        <label for="distrito_id">Distrito</label>
                                        <select class="form-select" name="distrito_id" id="distrito_id" wire:model="distrito_id" >
                                            <option value="">Todos</option>
                                            @foreach( $distritos as $distrito )
                                            <option value="{{ $distrito->id }}">{{ $distrito->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="concelho_id">Concelho</label>
                                        <select class="form-select" name="concelho_id" id="concelho_id" wire:model="concelho_id" >
                                            <option value="">Todos</option>
                                            @foreach( $concelhos as $concelho )
                                            <option value="{{ $concelho->id }}">{{ $concelho->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="localidade_id">Localidade</label>
                                        <select class="form-select" name="localidade_id" id="localidade_id" wire:model="localidade_id" >
                                            <option value="">Todas</option>
                                            @foreach( $localidades as $localidade )
                                            <option value="{{ $localidade->id }}">{{ $localidade->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label for="cpost">Código Postal</label>
                                        <input class="form-control" name="cpost" id="cpost" type="text" placeholder="1500-100" wire:model.lazy="cpost" />
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label for="search">Pesquisa</label>
                                        <input class="form-control" name="search" id="search" type="text" placeholder="Pesquisa..." wire:model.lazy="search" />
                                    </div>
                                </div>
                            </form>
                            @if( count( $codigos_postais ) > 0 )
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Distrito</th>
                                        <th>Concelho</th>
                                        <th>Localidade</th>
                                        <th>Código Postal</th>
                                        <th>Descritivo</th>
                                        <th>Arruamento</th>
                                        <th>Local</th>
                                        <th>Troço</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $codigos_postais as $codigo_postal )
                                    <tr>
                                        <td>{{ $codigo_postal->concelho->distrito->nome }}</td>
                                        <td>{{ $codigo_postal->concelho->nome }}</td>
                                        <td>{{ $codigo_postal->localidade->nome }}</td>
                                        <td>{{ $codigo_postal->codigo_postal }}</td>
                                        <td>{{ $codigo_postal->descritivo_postal }}</td>
                                        <td>{{ $codigo_postal->logradouro }}</td>
                                        <td>{{ $codigo_postal->local }}</td>
                                        <td>{{ $codigo_postal->troco }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $codigos_postais->links() }}
                            <p>{{ $codigos_postais->firstItem() . ' a ' . $codigos_postais->lastItem() . ' de ' . $codigos_postais->total() }} registos.</p>
                            @else
                            <p>Não foram encontrados registos.</p>
                            @endif
                        </div>
