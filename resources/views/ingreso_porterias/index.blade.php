@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="/css/ingreso-porteria.css">
@endpush
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <section>
            <div class="container forget-password">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="text-center">
                                    
                                    <h2 class="text-center">Ingreso</h2>
                                    <p>Validación de ingreso</p>
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="" placeholder='Escanerar documento' class='form-control' rows='3'></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="numero_documento" class="form-control" placeholder="Documento">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="nombres" class="form-control" placeholder="Nombres"> 
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="date" name="fecha_nacimiento" class="form-control" placeholder="Fecha nacimiento"> 
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="number" name="celular" class="form-control" placeholder="Celular"> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="btnForget" class="btn btn-lg btn-primary btn-block btnForget" id="validarIngreso" value="Validar Ingreso" type="button">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('flash::message')

    
@endsection

@push('page_scripts')
<script>
    var cliente = {};
    var manilla = {};
$(document).on('click','#validarIngreso', async function(event){
    var documento = $('input[name=numero_documento]').val();
    cliente = await validar_user(documento);
    manilla = await get_manilla(documento);



    Swal.fire({
        title: 'Mensaje',
        text: `Este usuario es de tipo ${cliente.tipo?cliente.tipo:'Visitante'}, el valor de la entrada es de $${numberFormat(manilla.precio_full)} `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Dar ingreso',
        cancellButtonText: 'Cancelar',
    }).then(async (result) => {
        if (result.isConfirmed) {
            var data = {
                cliente:cliente,
                manilla:manilla
            }
             var dar_ingreso_cliente = await dar_ingreso(data);
             //
             Swal.fire({
                title: 'Mensaje',
                text: `Ingreso validado correctamente`,
                icon: 'success',
                showCancelButton: true,
                showConfirmButton: false,
                cancelButtonText: 'Aceptar',
            }).then(async (result) => {
                $('#register-form').trigger('reset');
            })
        }



         //
    })

});

function validar_user(documento){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/clientes-by-documento/${documento}`,
            method:'get',
            success:function(info){
                resolve(info);
            }
        })
    });
}

function get_manilla(){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/api/manillas`,
            method:'get',
            success:function(info){
                resolve(info);
            }
        })
    });
}


function dar_ingreso(data){

    if(data.cliente==''){

        var formData = $('#register-form').serializeArray();
        var formObject = {};

        $.each(formData, function(index, field) {
            formObject[field.name] = field.value;
        });

        data.cliente = formObject;
        data.action = 'create';
    }
    
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/api/entregar-manilla-cliente`,
            method:'post',
            data:data,
            success:function(info){
                resolve(info);
            }
        })
    });
}


</script>
@endpush

