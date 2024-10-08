<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download($filename)
    {
        $path = 'exports/';
        $full_filename = $path . $filename;

        return Storage::download( $full_filename, $filename );
    }
}
