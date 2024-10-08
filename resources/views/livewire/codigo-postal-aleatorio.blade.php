<div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select wire:model="distrito_id" class="form-control">
                                            <option value="">Todos os distritos</option>
                                            @foreach( $distritos as $key => $value )
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Distrito</th>
                                            <th>Concelho</th>
                                            <th>Código Postal</th>
                                            <th>Descritivo Postal</th>
                                            <th>Local</th>
                                            <th>Troço</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $codigo_postal->concelho->distrito->nome }}</td>
                                            <td>{{ $codigo_postal->concelho->nome }}</td>
                                            <td>{{ $codigo_postal->codigo_postal }}</td>
                                            <td>{{ $codigo_postal->descritivo_postal }}</td>
                                            <td>{{ $codigo_postal->local }}</td>
                                            <td>{{ $codigo_postal->troco }}</td>
                                            <td><a href="{{ route('home', ['cp' => $codigo_postal->codigo_postal]) }}">Ver</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12"><button class="btn btn-success" wire:click="$refresh">Gerar novo</button></div>
                                </div>
                            </div>                                
