<div class="table-responsie">
    <table class="table datatableSimple" id="productos-table">
        <thead>
        <tr>
            <th>Icono</th>
            <th>Codigo de barras</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Cantidad Disponible</th>
            <th>Categoria</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productos as $producto)
            
            <tr>
                <td>
                    <img class='avatar-profile-table' src="/storage/{{$producto->icono}}" alt="">
                </td>
                <td>{{ $producto->sku }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                @if(!isset($producto->historial_producto))
                
                @endif
                <td>{{ number_format($producto->historial_producto->cantidad_actual) }}</td>
                <td>{{ isset($producto->categoria)?$producto->categoria->nombre:'Categoria eliminada' }}</td>
                <td width="120">
                    <div class='btn-group'>
                        <a href="javascript:void(0);"
                            producto_id="{{$producto->id}}"
                            class='btn btn-primary btn-xs btn-add-stcok {{is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja)?'disabled':''}}'>
                            <i class="far fa-edit "></i> Agregar
                        </a>
     
                                @if($producto->historial_producto->cantidad_actual>0)
                                <a style='margin-left:10px' href="javascript:void(0);"
                                    producto_id="{{$producto->id}}"
                                    class="btn btn-primary btn-xs btn-edit-stcok {{is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja)?'disabled':''}}">
                                    <i class="far fa-edit"></i> Editar
                                </a>
                                @endif
                    
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
