<div class="table-responsive">
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
            @php
                $cierreActivo = isset($cierreGlobal) && is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja);
                $disabledClass = $cierreActivo ? 'disabled' : '';
            @endphp
            <tr id="fila-producto-{{ $producto->id }}">
                <td>
                    <img class='avatar-profile-table' src="/storage/{{ $producto->icono }}" alt="">
                </td>
                <td>{{ $producto->sku }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{!! $producto->descripcion !!}</td>
                <td>{{ $producto->historial_producto ? number_format($producto->historial_producto->cantidad_actual) : '0' }}</td>
                <td>{{ isset($producto->categoria) ? $producto->categoria->nombre : 'Categoria eliminada' }}</td>
                <td width="220">
                    <div class="btn-group">

                        @if($producto->historial_producto && $producto->historial_producto->cantidad_actual > 0)
                            <a style="margin-left:10px" href="javascript:void(0);"
                                producto_id="{{ $producto->id }}"
                                class="btn btn-primary btn-xs btn-edit-stcok {{ $disabledClass }}">
                                <i class="far fa-edit"></i> Editar stock
                            </a>
                        @endif

                        <a style="margin-left:10px" href="javascript:void(0);"
                            producto_id="{{ $producto->id }}"
                            data-nombre="{{ $producto->nombre }}"
                            data-descripcion="{{ $producto->descripcion }}"
                            data-categoria_id="{{ $producto->categoria_id }}"
                            data-precio_venta="{{ optional($producto->historial_precio)->valor }}"
                            class="btn btn-warning btn-xs btn-editar-producto {{ $disabledClass }}">
                            <i class="far fa-edit"></i> Editar
                        </a>

                        <a style="margin-left:10px" href="javascript:void(0);"
                            producto_id="{{ $producto->id }}"
                            class="btn btn-danger btn-xs btn-eliminar-producto {{ $disabledClass }}">
                            <i class="fa fa-trash"></i> Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>