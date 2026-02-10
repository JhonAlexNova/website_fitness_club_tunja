@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar Configuración</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')
        @include('flash::message')

        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Linea grafica</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ModulosApp-tab" data-toggle="tab" data-target="#ModulosApp" type="button" role="tab" aria-controls="ModulosApp" aria-selected="false">Permisos</button>
        </li>

         <li class="nav-item" role="presentation">
            <button class="nav-link" id="modulosTipoNegocio-tab" data-toggle="tab" data-target="#modulosTipoNegocio" type="button" role="tab" aria-controls="modulosTipoNegocio" aria-selected="false">Permisos tipo negocio</button>
        </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
        
                    {!! Form::model($configuracion, ['route' => ['configuracions.update', $configuracion->id], 'method' => 'patch','files'=>true,'id'=>'formEditConfiguracion']) !!}
        
                    <div class="card-body">
                        <div class="row">
                            @include('configuracions.fields')
                        </div>
                    </div>
        
                    <div class="card-footer">
                        <button type="submit" class='btn btn-primary'><i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar</button>
                        <a href="{{ route('configuracions.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Volver</a>
                    </div>
        
                    {!! Form::close() !!}
                </div>


            </div>

            <div class="tab-pane fade" id="ModulosApp" role="tabpanel" aria-labelledby="ModulosApp-tab">
                <div class="card"><br>
                    <div class="container-fluid">
                        <h6>Modulos </h6><hr>
                        <table class='table table-bordered'>
                            
                                <thead>
                                    <tr>
                                        <td>Modulo</td>
                                        @foreach($rols as $rol)
                                            <td> {{ $rol->tipo }} </td>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($modulos_app as $modulo)
                                        <tr class='modulo-{{$modulo->id}}'>
                                            <td>  {{ $modulo->nombre }}  <input type="hidden" name='modulo_id' value='{{$modulo->id}}'> </td>
                                            @foreach($rols as $rol)
                                                <td>  <input type="checkbox" name='rol_id' value='{{$rol->id}}' > </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane fade" id="modulosTipoNegocio" role="tabpanel" aria-labelledby="modulosTipoNegocio-tab">
                <div class="card"><br>
                    <div class="container-fluid">
                        <h6>Modulos </h6><hr>

                        <div class="accordion" id="accordionExample">
                        @foreach($tipos_negocio as $index => $tipo)
                            <div class="card">
                                <div class="card-header" id="heading-{{$index}}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-{{$index}}" aria-expanded="true" aria-controls="collapse-{{$index}}">
                                        {{ $tipo->nombre }}
                                        <input type="hidden" name="tipo_negocio_id" value='{{$tipo->id}}'>
                                    </button>
                                </h2>
                                </div>

                                <div id="collapse-{{$index}}" class="collapse show tipo_negocio_{{$tipo->id}}"  aria-labelledby="heading-{{$index}}" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class='table table-bordered'>
                                            <tr>
                                                <thead>
                                                    <td>Modulo</td>
                                                    <td>Estado</td>
                                                </thead>
                                                <tbody>
                                                    @foreach($all_modulos_app as $modulo)
                                                        <tr class='modulo-tipo-negocio-{{$modulo->id}}'>
                                                            <td>  {{ $modulo->nombre }}  </td>
                                                            <td>  <input type="checkbox" name='modulo_app_id'   value='{{$modulo->id}}'> </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                           
                        

                    </div>
                </div>
            </div>


            


        </div>
    </div>
@endsection

@push('page_scripts')

<script src='https://zipaquiraturistica.com/dashboard-zipa-turis/lib/ckeditor/ckeditor.js'></script>
<script>
    CKEDITOR.replace('politicas_de_privacidad', {
        filebrowserUploadUrl: 'https://zipaquiraturistica.com/dashboard-zipa-turis/uploads-ckeditor',
        filebrowserUploadMethod: 'post'
    });


    get_permisos();
    function get_permisos(){
            $.ajax({
            url: '{{route("permisos.index")}}',
            type: 'GET',
            success: function(response) {
                $.each(response, function(e){
                    var filaModulo = $(`.modulo-${this.modulo_id}`);
                    var inputs = $(filaModulo).find(`input[name=rol_id][value=${this.roles_id}]`).prop('checked',true);          
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                // Manejar errores aquí
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    }


    get_permisos_tipo_negocio();
    function get_permisos_tipo_negocio(){
            $.ajax({
            url: '/admon/config/permisos-tipo-negocio',
            type: 'GET',
            success: function(response) {
                for(var tipo_negocio of response){
                    for(var elemento of tipo_negocio.modulos_tipo_negocio){                        
                        var inputs = $(`.tipo_negocio_${tipo_negocio.id}  input[name=modulo_app_id][value=${elemento.modulo_id}]`).prop('checked',true);          
                    }
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Manejar errores aquí
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    }


    $(document).on('change',"#modulosTipoNegocio input[name=modulo_app_id]",function(event){
        var tipo_negocio_id = $(this).closest('.card').find('input[name=tipo_negocio_id]').val();
        var modulo_id = $(this).val();

        var data = {
            tipo_negocio_id:tipo_negocio_id,
            modulo_id:modulo_id
        };
        

        
        //
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admon/config/permisos-tipo-negocio',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': csrfToken // Incluir el token CSRF en los encabezados
            },
            success: function(data) {
                toastr.success(data.response,'Mensaje',toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });


               /*  if(data.estado==1){
                    toastr.success('Permiso agregado correctamente','Mensaje',toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                }else{
                    toastr.success('Permiso desabilitado correctamente','Mensaje',toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                } */
            
            },
            error: function(xhr, textStatus, errorThrown) {
                // Manejar errores aquí
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
        //
    });
    
    $('input[name=rol_id]').on('change', function(e) {
        var modulo_id = $(this).closest('tr').find('input[name=modulo_id]').val();
        var rol_id = $(this).val();
        var data = {
            estado: 0,
            modulo_id: modulo_id,
            rol_id:rol_id
        };
    if ($(this).prop('checked')) {
        data.estado = 1;
    } else {
        data.estado = 0;
    }
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/admon/permisos',
        type: 'POST',
        data: data,
        headers: {
            'X-CSRF-TOKEN': csrfToken // Incluir el token CSRF en los encabezados
        },
        success: function(response) {
            if(data.estado==1){
                toastr.success('Permiso agregado correctamente','Mensaje',toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            }else{
                toastr.success('Permiso desabilitado correctamente','Mensaje',toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            }
        
        },
        error: function(xhr, textStatus, errorThrown) {
            // Manejar errores aquí
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    });


    
});

</script>
@endpush