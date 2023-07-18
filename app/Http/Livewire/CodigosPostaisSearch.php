<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CodigosPostaisSearch extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $cpost = '';
    public $search = '';

    public function mount()
    {
        $this->cpost = '';
        $this->search = '';
    }

    public function render()
    {
        if ( ! empty( $this->cpost ) ) {
            $cpost = explode('-', $this->cpost);
            $cpost_4 = $cpost[0];
            if ( count($cpost ) > 1 ) {
                $cpost_3 = $cpost[1];
            } else {
                $cpost_3 = '';
            }

        } else {
            $cpost_4 = '';
            $cpost_3 = '';
        }

        $codigos_postais_1 = DB::table('codigo_postals')
            ->select(['cpost_4', 'cpost_3', 'descritivo_postal', DB::raw('\'CP\' AS tipo')])
            ->when($cpost_4, function ($query) use($cpost_4) {
                $query->where('codigo_postals.cpost_4', $cpost_4);

            })->when($cpost_3, function ($query) use($cpost_3) {
            $query->where('codigo_postals.cpost_3', $cpost_3);

            })->when($this->search != '', function ($query) {
                $query->where(function ( $q ) {
                    $q->where('codigo_postals.descritivo_postal', 'like', '%' . $this->search . '%');
                });
            });

        $codigos_postais = DB::table('apartados')
            ->select(['cpost_4', 'cpost_3', 'descritivo_postal', DB::raw('\'AP\' AS tipo')])
            ->when($cpost_4, function ($query) use($cpost_4) {
                $query->where('apartados.cpost_4', $cpost_4);

            })->when($cpost_3, function ($query) use($cpost_3) {
            $query->where('apartados.cpost_3', $cpost_3);

            })->when($this->search != '', function ($query) {
                $query->where(function ( $q ) {
                    $q->where('apartados.descritivo_postal', 'like', '%' . $this->search . '%');
                });
            })->union($codigos_postais_1)
            ->orderBy('cpost_4')->orderBy('cpost_3')
            ->paginate(10);

        return view('livewire.codigos-postais-search', compact('codigos_postais'));
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function updatedCpost()
    {
        $this->search = '';
    }
}
