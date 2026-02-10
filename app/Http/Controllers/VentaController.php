<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Repositories\EmpleadoRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\CategoriaRepository;

use Auth;

class VentaController extends Controller
{
    
    
    private $empleadoRepository;
    private $productoRepository;
    private $categoriaRepository;

    public function __construct(
        EmpleadoRepository $empleadoRepo,
        ProductoRepository $productoRepo,
        CategoriaRepository $categoriaRepo
    )
    {
        $this->empleadoRepository = $empleadoRepo;
        $this->productoRepository = $productoRepo;
        $this->categoriaRepository = $categoriaRepo;
    }

    public function index()
    {
        $empleados = $this->empleadoRepository->withRelations();
        $productos = $this->productoRepository->withRelations();

        $backpack = [
            'empleados' => $empleados,
            'productos' => $productos
        ];


        return view('ventas.index', $backpack);
    }


    public function ventas2(){
        $categorias = $this->categoriaRepository->all();

        $backpack = [
            "categorias" => $categorias
        ];


        
        
        return view("ventas.template2",$backpack);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
