<div>
                            <form action="{{ route('search') }}" method="POST">
                                @csrf
                                <div class="row mb-4">
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
                                        <th>Código Postal</th>
                                        <th>Descritivo</th>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $codigos_postais as $codigo_postal )
                                    <tr>
                                        <td>{{ $codigo_postal->cpost_4 . '-' .  $codigo_postal->cpost_3 }}</td>
                                        <td>{{ $codigo_postal->descritivo_postal }}</td>
                                        <td>{{ $codigo_postal->tipo == 'CP' ? 'Código Postal' : 'Apartado' }}</td>
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
