<div class="tabl">
    <table class="table datatableSimple" id="instructors-table">
        <thead>
        <tr>
               <th>Foto Perfil</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Celular</th>
                <th>Estado</th>
                <th>Email</th>
                <th>Documento</th>
                <th >Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($instructors as $instructor)
            <tr>
                <td> 
                    <img src="{{!is_null($instructor->foto_perfil)?url('storage',$instructor->foto_perfil):'img/avatar.png'}}" style="width:50px" alt="">
                </td>
                <td>{{ $instructor->primer_nombre }}</td>
                <td>{{ $instructor->segundo_nombre }}</td>
                <td>{{ $instructor->primer_apellido }}</td>
                <td>{{ $instructor->segundo_apellido }}</td>
                <td>{{ $instructor->celular }}</td>
                <td>{{ $instructor->estado }}</td>
                <td>{{ $instructor->email }}</td>
                <td>{{ $instructor->documento }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['instructors.destroy', $instructor->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <!-- <a href="{{ route('instructors.show', [$instructor->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a> -->
                        <a href="{{ route('instructors.edit', [$instructor->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
