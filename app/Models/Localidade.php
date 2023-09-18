<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidade extends Model
{
    use HasFactory;

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

    public function concelho()
    {
        return $this->belongsTo(Concelho::class);
    }

    public function codigos_postais()
    {
        return $this->hasMany(CodigoPostal::class);
    }
}
