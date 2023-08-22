                <div class="sidebar-heading border-bottom bg-light">{{ env('APP_NAME' )}}</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Pesquisa por Códigos Postais</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('apartados') ? 'active' : '' }}" href="{{ route('apartados') }}">Pesquisa de Apartados</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('codigo-postal') ? 'active' : '' }}" href="{{ route('codigo-postal') }}">Pesquisa por Todos</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('aleatorio') ? 'active' : '' }}" href="{{ route('aleatorio') }}">Código Postal aleatório</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('export') ? 'active' : '' }}" href="{{ route('export') }}">Exportar Códigos Postais</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('apartados-export') ? 'active' : '' }}" href="{{ route('apartados.export') }}">Exportar Apartados</a>
                </div>
