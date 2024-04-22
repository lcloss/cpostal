<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class CodigoPostalExport extends Component
{
    public $tipo;
    public $distritos = [];
    public $distrito_id = 0;
    public $concelhos = [];
    public $concelho_id = 0;

    public function mount()
    {
        $this->tipo = 'codigos_postais';
        $this->distritos = Distrito::orderBy('nome')->get();
    }

    public function render()
    {
        return view('livewire.codigo-postal-export', ['distritos' => $this->distritos, 'concelhos' => $this->concelhos]);
    }

    public function updatedDistritoId($distrito_id)
    {
        $distrito = Distrito::find($distrito_id);
        $this->concelhos = $distrito->concelhos()->orderBy('nome')->get();
        $this->concelho_id = 0;
    }
}
