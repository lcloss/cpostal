<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    public function concelhos()
    {
        return $this->hasMany(Concelho::class);
    }

    public function localidades()
    {
        return $this->hasMany(Localidade::class);
    }

    public function codigos_postais()
    {
        return $this->hasMany(CodigoPostal::class);
    }
}
