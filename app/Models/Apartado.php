<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartado extends Model
{
    use HasFactory;

    public function getCodigoPostalAttribute()
    {
        return $this->cpost_4 . '-' . $this->cpost_3;
    }
}
