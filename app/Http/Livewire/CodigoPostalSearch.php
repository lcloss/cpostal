<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;

use Livewire\Component;
use App\Models\Distrito;
use App\Models\Concelho;
use App\Models\Localidade;
use App\Models\CodigoPostal;

class CodigoPostalSearch extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $distrito_id = '';
    public $concelho_id = '';
    public $localidade_id = '';
    public $cpost = '';
    public $search = '';

    public function mount($cp = '')
    {
        $this->distrito_id = '';
        $this->concelho_id = '';
        $this->localidade_id = '';
        $this->cpost = $cp;
        $this->search = '';
    }

    public function render()
    {
        $distritos = Distrito::orderBy('nome')->get();

        if ( ! empty( $this->distrito_id ) ) {
            $concelhos = Concelho::where('distrito_id', $this->distrito_id)->orderBy('nome')->get();
        } else {
            $concelhos = collect();
        }

        if ( ! empty( $this->concelho_id ) ) {
            $localidades = Localidade::where('concelho_id', $this->concelho_id)->orderBy('nome')->get();
        } else {
            $localidades = collect();
        }

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

        $codigos_postais = CodigoPostal::when($this->distrito_id, function ($query) {
            $query->whereHas('concelho', function ($query) {
                $query->whereHas('distrito', function ($query) {
                    $query->where('id', $this->distrito_id);
                });
            });

        })->when($this->concelho_id, function ($query) {
            $query->whereHas('concelho', function ($query) {
                $query->where('concelho_id', $this->concelho_id);
            });
        })->when($this->localidade_id, function ($query) {
            $query->where('localidade_id', $this->localidade_id);

        })->when($cpost_4, function ($query) use($cpost_4) {
            if (strlen($cpost_4) == 4) {
                $query->where('cpost_4', $cpost_4);
            } else {
                $query->where('cpost_4', 'like', $cpost_4 . '%');
            }

        })->when($cpost_3, function ($query) use($cpost_3) {
            if (strlen($cpost_3) == 3) {
                $query->where('cpost_3', $cpost_3);
            } else {
                $query->where('cpost_3', 'like', $cpost_3 . '%');
            }

        })->when($this->search != '', function ($query) {
            $query->where(function ($q) {
                // $q->where('descritivo_postal', 'like', '%' . $this->search . '%')
                //     ->orWhere('logradouro', 'like', '%' . $this->search . '%');
                $q->where('descritivo_postal', 'like', '%' . $this->search . '%')
                    ->orWhere('local', 'like', '%' . $this->search . '%')
                    ->orWhere('logradouro', 'like', '%' . $this->search . '%');
            });

        })->orderBy('cpost_4')->orderBy('cpost_3')->paginate(10);
        // })->simplePaginate(10);

        return view('livewire.codigo-postal-search', compact('distritos', 'concelhos', 'localidades', 'codigos_postais'));
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function updatedDistritoId()
    {
        $this->concelho_id = '';
    }

    public function updatedConcelhoId()
    {
        $this->localidade_id = '';
    }

    public function updatedLocalidadeId()
    {
        $this->cpost = '';
    }

    public function updatedCpost()
    {
        $this->search = '';
    }
}
