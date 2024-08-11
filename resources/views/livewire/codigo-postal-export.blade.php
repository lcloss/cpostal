                            <form action="{{ route('export.run') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select name="tipo" id="tipo" class="form-control" wire:model="tipo">
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
                                    @if( $tipo == 'codigos_postais' )
                                    <div class="col-md-2">
                                        <label for="distrito" class="form-label">Distrito</label>
                                        <select name="distrito" id="distrito" class="form-control" wire:model="distrito_id">
                                            <option value=0>Todos os Distritos</option>
                                            @foreach( $distritos as $distrito )
                                                <option value="{{ $distrito->id }}">{{ $distrito->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if( $distrito_id != 0 )
                                    <div class="col-md-2">
                                        <label for="concelho" class="form-label">Concelho</label>
                                        <select name="concelho" id="concelho" class="form-control" wire:model="concelho_id">
                                            <option value=0>Todos os Concelhos</option>
                                            @foreach( $concelhos as $concelho )
                                                <option value="{{ $concelho->id }}">{{ $concelho->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Exportar</button>
                                    </div>
                                </div>
                            </form>
