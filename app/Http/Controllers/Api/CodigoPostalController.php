<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodigoPostal;
use App\Http\Resources\CodigoPostalResource;

class CodigoPostalController extends Controller
{
    public function index()
    {
        return CodigoPostal::paginate(10);
    }
    public function postal($postal_code)
    {
        if ( strlen( $postal_code ) > 4 ) {
            $postal_code = str_replace('-', '', $postal_code);
            $postal_code = str_replace(' ', '', $postal_code);
            $cpost_4 = substr($postal_code, 0, 4);
            $cpost_3 = substr($postal_code, 4);
        } else {
            $cpost_4 = $postal_code;
            $cpost_3 = '';
        }
        // return [$postal_code, $cpost_4, $cpost_3];

        $codigos_postais = CodigoPostal::with(['distrito', 'concelho', 'localidade'])
        ->where('cpost_4', $cpost_4)
            ->when( $cpost_3 != '', function ($query) use ($cpost_3) {
                return $query->where('cpost_3', $cpost_3);
            })
            ->get();

        return CodigoPostalResource::collection($codigos_postais);
    }
}
