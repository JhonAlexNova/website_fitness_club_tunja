{{-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> --}}
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
    <!-- Sección de Inicio -->
    @foreach($permisosModulos as $elemento)
        @if(isset($elemento['modulo']))
            @php
                $rolesPermitidos = explode(',', $elemento['roles_id']);
            @endphp

            @if(in_array(Auth::user()->rol_id(), $rolesPermitidos))
                <!-- INICIO -->
                @if($elemento['modulo']['nombre'] === 'INICIO')
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                @endif

                <!-- PORTERÍA -->
                @if($elemento['modulo']['nombre'] === 'INGRESO_PORTERIA')
                <li class="nav-item">
                    <a href="{{ route('ingreso-porteria.index') }}" class="nav-link {{ Request::is('ingreso-porteria*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>Ingreso portería</p>
                    </a>
                </li>
                @endif

                @if($elemento['modulo']['nombre'] === 'PORTERIA')
                <li class="nav-item">
                    <a href="{{ route('ventas.porteria') }}" class="nav-link {{ Request::is('ventas-porteria') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Ventas portería</p>
                    </a>
                </li>
                @endif

                @if($elemento['modulo']['nombre'] === 'MANILLAS_PORTERIA')
                <li class="nav-item">
                    <a href="{{ route('manillaEntradas.index') }}" class="nav-link {{ Request::is('manillaEntradas*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>Manillas entrada</p>
                    </a>
                </li>
                @endif

                <!-- INVENTARIO Y PRODUCTOS -->
                @if($elemento['modulo']['nombre'] === 'TRASLADOS_PRODUCTOS')
                <li class="nav-item">
                    <a href="{{ route('trasladoProductos.index') }}" class="nav-link {{ Request::is('trasladoProductos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck-moving"></i>
                        <p>Traslados</p>
                    </a>
                </li>
                @endif

                @if($elemento['modulo']['nombre'] === 'INVENTARIO')
                <li class="nav-item">
                    <a href="{{ route('stock.index') }}" class="nav-link {{ Request::is('stock*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Inventario</p>
                    </a>
                </li>
                @endif

                @if($elemento['modulo']['nombre'] === 'CAMBIOS_PRODUCTOS')
                <li class="nav-item">
                    <a href="{{ url('cambios-x-producto') }}" class="nav-link {{ Request::is('cambios-x-producto*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Cambios productos</p>
                    </a>
                </li>
                @endif

                <!-- VENTAS Y PAGOS -->
                @if($elemento['modulo']['nombre'] === 'VENTAS')
                <li class="nav-item">
                    <a href="{{ route('ventas.index') }}" class="nav-link {{ Request::is('ventas') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Ventas</p>
                    </a>
                </li>
                @endif

                @if($elemento['modulo']['nombre'] === 'PAGOS')
                <li class="nav-item">
                    <a href="{{ route('pagos.index') }}" class="nav-link {{ Request::is('pagos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Pagos
                            @include('partials.notificaciones_menu_badge', ['tabla' => 'pagos'])
                        </p>
                    </a>
                </li>
                @endif

                <!-- CLIENTES -->
                @if($elemento['modulo']['nombre'] === 'CLIENTES')
                <li class="nav-item">
                    <a href="{{ route('clientes.index') }}" class="nav-link {{ Request::is('clientes*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Clientes</p>
                    </a>
                </li>
                @endif

                <!-- DEVOLUCIONES -->
                @if($elemento['modulo']['nombre'] === 'DEVOLUCIONES')
                <li class="nav-item">
                    <a href="{{ route('devolucions.index') }}" class="nav-link {{ Request::is('devolucions*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-undo"></i>
                        <p>Devoluciones</p>
                    </a>
                </li>
                @endif

                @if($elemento['modulo']['nombre'] === 'DEVOLUCION_SIMPLE')
                <li class="nav-item">
                    <a href="{{ route('devoluciones-simples.index') }}" class="nav-link {{ Request::is('devoluciones-simples*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-undo-alt"></i>
                        <p>Devoluciones simples</p>
                    </a>
                </li>
                @endif

                <!-- CHICOS -->
                @if($elemento['modulo']['nombre'] === 'CHICOS')
                <li class="nav-item">
                    <a href="{{ route('chicos.index') }}" class="nav-link {{ Request::is('chicos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-child"></i>
                        <p>Chicos</p>
                    </a>
                </li>
                @endif

                <!-- ASISTENCIA -->
                @if($elemento['modulo']['nombre'] === 'ASISTENCIA_EMPLEADOS')
                <li class="nav-item">
                    <a href="{{ route('asistenciaEmpleados.index') }}" class="nav-link {{ Request::is('asistenciaEmpleados*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>Asistencia Empleados</p>
                    </a>
                </li>
                @endif

                <!-- CATÁLOGO -->
                @if($elemento['modulo']['nombre'] === 'CATALOGO')
                @php
                    $isCatalogoActive = Request::is('productos*') || Request::is('categorias*') || Request::is('stock*');
                @endphp
                <li class="nav-item {{ $isCatalogoActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isCatalogoActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Catálogo
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isCatalogoActive ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('productos.index') }}" class="nav-link {{ Request::is('productos*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categorias.index') }}" class="nav-link {{ Request::is('categorias*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stock.index') }}" class="nav-link {{ Request::is('stock*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('coffee-products.index') }}" 
                            class="nav-link {{ Request::is('admon/coffee-products*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Coffee Shop</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- USUARIOS -->
                @if($elemento['modulo']['nombre'] === 'USUARIOS')
                @php
                    $isUsuariosActive = Request::is('instructors*') || Request::is('clientes*');
                @endphp
                <li class="nav-item {{ $isUsuariosActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isUsuariosActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Usuarios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isUsuariosActive ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('instructors.index') }}" class="nav-link {{ Request::is('instructors*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Instructores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clientes.index') }}" class="nav-link {{ Request::is('clientes*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- REPORTES -->
                @if($elemento['modulo']['nombre'] === 'REPORTES')
                @php
                    $isReportesActive = Request::is('reporte_ventas*') || Request::is('reportes/inventario');
                @endphp
                <li class="nav-item {{ $isReportesActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isReportesActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Reportes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isReportesActive ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ url('reportes/ventas') }}" class="nav-link {{ Request::is('reporte_ventas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ventas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('reportes/inventario') }}" class="nav-link {{ Request::is('reportes/inventario*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- CONFIGURACIÓN -->
                @if($elemento['modulo']['nombre'] === 'CONFIGURACION')
                @php
                    $isConfigActive = Request::is('sedes*') || Request::is('configuracions*') || Request::is('metodoPagos*') || 
                                     Request::is('caracteristicas*') || Request::is('valorCaracteristicas*') || 
                                     Request::is('variacionProductos*') || Request::is('caracteristicaProductos*');
                @endphp
                <li class="nav-item {{ $isConfigActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isConfigActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Configuración
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isConfigActive ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('sedes.index') }}" class="nav-link {{ Request::is('sedes*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sedes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('configuracions.index') }}" class="nav-link {{ Request::is('configuracions*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Configuración</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('metodoPagos.index') }}" class="nav-link {{ Request::is('metodoPagos*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Métodos de pago</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('caracteristicas.index') }}" class="nav-link {{ Request::is('caracteristicas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Características</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('valorCaracteristicas.index') }}" class="nav-link {{ Request::is('valorCaracteristicas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Valor Características</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('variacionProductos.index') }}" class="nav-link {{ Request::is('variacionProductos*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Variación Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('caracteristicaProductos.index') }}" class="nav-link {{ Request::is('caracteristicaProductos*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Característica Productos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- CLASES -->
                @if($elemento['modulo']['nombre'] === 'CLASES')
                @php
                    $isClasesActive = Request::is('clases*') || Request::is('horarioClaseUnicas*') || 
                                      Request::is('claseRecurrentes*') || Request::is('reservas*');
                @endphp
                <li class="nav-item {{ $isClasesActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isClasesActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Clases
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isClasesActive ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('admon.clases.index') }}" class="nav-link {{ Request::is('clases*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clases</p>
                            </a>
                        </li>
                       {{--  <li class="nav-item">
                            <a href="{{ route('horarioClaseUnicas.index') }}" class="nav-link {{ Request::is('horarioClaseUnicas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Horario Clase Únicas</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('claseRecurrentes.index') }}" class="nav-link {{ Request::is('claseRecurrentes*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Horarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reservas.index') }}" class="nav-link {{ Request::is('reservas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reservas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- MEMBRESÍAS -->
                @if($elemento['modulo']['nombre'] === 'MEMBRESIAS')
                @php
                    $isMembresiasActive = Request::is('membresias*') || Request::is('userMembresias*') || Request::is('pagoMembresias*') || Request::is('pasadias*');
                @endphp
                <li class="nav-item {{ $isMembresiasActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isMembresiasActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>
                            Membresías
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isMembresiasActive ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('membresias.index') }}" class="nav-link {{ Request::is('membresias*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Membresías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pasadias.index') }}" class="nav-link {{ Request::is('pasadias*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pasadías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('userMembresias.index') }}" class="nav-link {{ Request::is('userMembresias*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Membresías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pagoMembresias.index') }}" class="nav-link {{ Request::is('pagoMembresias*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Pago Membresías
                                    @include('partials.notificaciones_menu_badge', ['tabla' => 'facturas', 'tipos' => ['factura_membresia']])
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- RUTINAS -->
                @if($elemento['modulo']['nombre'] === 'RUTINAS')
                @php
                    $isRutinasActive = Request::is('ejercicios*') || Request::is('rutinas*') || 
                                      Request::is('rutinaEjercicios*') || Request::is('userRutinas*');
                @endphp
                <li class="nav-item {{ $isRutinasActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isRutinasActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-dumbbell"></i>
                        <p>
                            Rutinas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isRutinasActive ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('ejercicios.index') }}" class="nav-link {{ Request::is('ejercicios*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ejercicios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('musculos.index') }}" class="nav-link {{ Request::is('musculos*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Musculos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admon.rutinas.index') }}" class="nav-link {{ Request::is('rutinas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rutinas</p>
                            </a>
                        </li>
                        {{-- ✅ NUEVO --}}
                        <li class="nav-item">
                            <a href="{{ route('admon.rutinas-diarias-elite.index') }}"
                            class="nav-link {{ Request::is('admon/rutinas-diarias-elite*') ? 'active' : '' }}">
                                <i class="fas fa-fire-alt nav-icon text-warning"></i>
                                <p>Rutinas Diarias Elite</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            @endif
        @endif
    @endforeach

    <!-- MENSAJES -->
    @php
        $isMensajesActive = Request::is('smsTemplates*') || Request::is('sms/send*');
    @endphp
    <li class="nav-item {{ $isMensajesActive ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ $isMensajesActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-sms"></i>
            <p>
                Mensajes
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="{{ $isMensajesActive ? 'display: block;' : 'display: none;' }}">
            <li class="nav-item">
                <a href="{{ route('smsTemplates.index') }}" class="nav-link {{ Request::is('smsTemplates*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Plantillas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sms.send.create') }}" class="nav-link {{ Request::is('sms/send*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Enviar</p>
                </a>
            </li>
        </ul>
    </li>

    <!-- SERVICIOS -->
    <li class="nav-item">
        <a href="{{ route('servicios.index') }}" class="nav-link {{ Request::is('servicios*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-concierge-bell"></i>
            <p>Servicios</p>
        </a>
    </li>

    <!-- MEDICIONES -->
    <li class="nav-item">
        <a href="{{ route('medicions.index') }}" class="nav-link {{ Request::is('medicions*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-ruler-combined"></i>
            <p>Mediciones</p>
        </a>
    </li>

    <!-- PUNTOS -->
    <li class="nav-item">
        <a href="{{ route('puntos.index') }}" class="nav-link {{ Request::is('puntos*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-coins"></i>
            <p>Puntos</p>
        </a>
    </li>

    <!-- TRANSACCIONES -->
    <li class="nav-item">
        <a href="{{ route('transaccions.index') }}" class="nav-link {{ Request::is('transaccions*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
                Transacciones
                @include('partials.notificaciones_menu_badge', ['tabla' => 'facturas', 'tipos' => ['factura_tienda', 'wompi_webhook']])
            </p>
        </a>
    </li>

    <!-- CÓDIGOS INFLUENCERS -->
    <li class="nav-item">
        <a href="{{ route('codigos-influencers.index') }}" class="nav-link {{ Request::is('codigos-influencers*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tag"></i>
            <p>Códigos Influencers</p>
        </a>
    </li>
</ul>
