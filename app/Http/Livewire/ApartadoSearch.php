<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Apartado;

class ApartadoSearch extends Component
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

        $codigos_postais = Apartado::when($cpost_4, function ($query) use($cpost_4) {
            $query->where('cpost_4', $cpost_4);

        })->when($cpost_3, function ($query) use($cpost_3) {
            $query->where('cpost_3', $cpost_3);

        })->when($this->search != '', function ($query) {
            $query->where(function ($q) {
                $q->where('descritivo_postal', 'like', '%' . $this->search . '%')
                    ->orWhere('tipo', 'like', '%' . $this->search . '%')
                    ->orWhere('denominacao', 'like', '%' . $this->search . '%');
            });

        })->orderBy('cpost_4')->orderBy('cpost_3')->paginate(10);

        return view('livewire.apartado-search', compact('codigos_postais'));
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
