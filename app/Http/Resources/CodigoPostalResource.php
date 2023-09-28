<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CodigoPostalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cliente' => $this->cliente,
            'codigo_postal' => $this->cpost_4 . '-' . $this->cpost_3,
            'morada' => $this->logradouro,
            'porta' => $this->porta,
            'troco' => $this->troco,
            'descritivo' => $this->descritivo_postal,
            'localidade' => $this->localidade->nome,
            'concelho' => $this->concelho->nome,
            'distrito' => $this->distrito->nome,
        ];
        // return parent::toArray($request);
    }
}
