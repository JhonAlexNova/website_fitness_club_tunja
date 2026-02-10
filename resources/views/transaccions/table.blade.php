<div class="table-responsive">
    <table class="table" id="transaccions-table">
        <thead>
        <tr>
            <th>Amountincents</th>
            <th>Createdat</th>
            <th>Currency</th>
            <th>Customerdata Fullname</th>
            <th>Customerdata Phonenumber</th>
            <th>Customeremail</th>
            <th>Id Transaction</th>
            <th>Paymentmethod Extra Brand</th>
            <th>Paymentmethod Extra Externalidentifier</th>
            <th>Paymentmethod Extra Lastfour</th>
            <th>Paymentmethod Extra Name</th>
            <th>Paymentmethod Installments</th>
            <th>Paymentmethod Type</th>
            <th>Reference</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transaccions as $transaccion)
            <tr>
                <td>{{ $transaccion->amountInCents }}</td>
                <td>{{ $transaccion->createdAt }}</td>
                <td>{{ $transaccion->currency }}</td>
                <td>{{ $transaccion->customerData_fullName }}</td>
                <td>{{ $transaccion->customerData_phoneNumber }}</td>
                <td>{{ $transaccion->customerEmail }}</td>
                <td>{{ $transaccion->id_transaction }}</td>
                <td>{{ $transaccion->paymentMethod_extra_brand }}</td>
                <td>{{ $transaccion->paymentMethod_extra_externalIdentifier }}</td>
                <td>{{ $transaccion->paymentMethod_extra_lastFour }}</td>
                <td>{{ $transaccion->paymentMethod_extra_name }}</td>
                <td>{{ $transaccion->paymentMethod_installments }}</td>
                <td>{{ $transaccion->paymentMethod_type }}</td>
                <td>{{ $transaccion->reference }}</td>
                <td>{{ $transaccion->status }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['transaccions.destroy', $transaccion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('transaccions.show', [$transaccion->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('transaccions.edit', [$transaccion->id]) }}"
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
