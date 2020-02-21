<?php


namespace App\Http\Controllers;


class Artwork extends Controller
{

    public function serve($filename) {
        return response()->download(storage_path('app/artworks/' . $filename));
    }

}
