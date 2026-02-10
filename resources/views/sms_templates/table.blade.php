<div class="table-responsive">
    <table class="table" id="smsTemplates-table">
        <thead>
        <tr>
            <th>Name</th>
        <th>Content</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($smsTemplates as $smsTemplate)
            <tr>
                <td>{{ $smsTemplate->name }}</td>
            <td>{{ $smsTemplate->content }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['smsTemplates.destroy', $smsTemplate->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('smsTemplates.show', [$smsTemplate->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('smsTemplates.edit', [$smsTemplate->id]) }}"
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
