<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CodigoPostal;
use App\Models\Distrito;

class CodigoPostalAleatorio extends Component
{
    public $distrito_id;

    public function mount()
    {
        $this->distrito_id = '';
    }

    public function render()
    {
        $distritos = Distrito::orderBy('nome')->pluck('nome', 'id')->toArray();

        $codigo_postal = CodigoPostal::when($this->distrito_id, function ($query) {
            $query->whereHas('concelho', function ($query) {
                $query->whereHas('distrito', function ($query) {
                    $query->where('id', $this->distrito_id);
                });
            });
        })->inRandomOrder()->first();

        return view('livewire.codigo-postal-aleatorio', compact('codigo_postal', 'distritos'));
    }
}
