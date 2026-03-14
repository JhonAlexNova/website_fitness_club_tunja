<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Musculo;

class MusculoApiController extends Controller
{
    public function index()
    {
        $musculos = Musculo::orderBy('nombre')->get();
        return response()->json($musculos);
    }
}