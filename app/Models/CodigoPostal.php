<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoPostal extends Model
{
    use HasFactory;

    public function getCodigoPostalAttribute()
    {
        return $this->cpost_4 . '-' . $this->cpost_3;
    }
    
    public function concelho()
    {
        return $this->belongsTo(Concelho::class);
    }

    public function localidade()
    {
        return $this->belongsTo(Localidade::class);
    }
}
