<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function verImagen($archivo){
        try {
            $path = ('public/' . $archivo);         
            // Storage::get($path);
            return response()->file(Storage::path(trim($path)));
        } catch (\Throwable $th) {
            dd($th);
            throw new NotFoundHttpException();
        }
    }
}
