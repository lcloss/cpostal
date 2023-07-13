<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concelho extends Model
{
    use HasFactory;

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
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
