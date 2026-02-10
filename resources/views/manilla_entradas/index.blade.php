@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manilla Entradas</h1>
                </div>
                <div class="col-sm-6">
                   <!--  <a class="btn btn-primary float-right"
                       href="{{ route('manillaEntradas.create') }}">
                        Add New
                    </a> -->
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('manilla_entradas.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

       
       
       
    <form action="" class='formAgregarManillas'>
            
            <!-- Modal -->
            <div class="modal fade" id="modalAgregarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar manillas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Cantidad</label>
                                <input type="number" class='form-control' name='cantidad'>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>



@endsection


@push('page_scripts')
<script>
        var manilla_id = null;

       $(document).on('click','.btnAddManillas',function(event){
            $("#modalAgregarStock").modal("show");

            manilla_id = $(this).attr("data-manilla-id");
       });

    $(document).on('submit','.formAgregarManillas',function(event){
        event.preventDefault();
        var data = {
            cantidad:$("input[name=cantidad]").val(),
            manilla_id:manilla_id
        }
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/stockManillas',
            method:'post',
            data:data,
            success:function(e){
                location.reload();
            }
        })
    });
</script>
@endpush
