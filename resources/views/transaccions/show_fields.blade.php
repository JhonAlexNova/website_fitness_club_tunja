<!-- Amountincents Field -->
<div class="col-sm-12">
    {!! Form::label('amountInCents', 'Amountincents:') !!}
    <p>{{ $transaccion->amountInCents }}</p>
</div>

<!-- Createdat Field -->
<div class="col-sm-12">
    {!! Form::label('createdAt', 'Createdat:') !!}
    <p>{{ $transaccion->createdAt }}</p>
</div>

<!-- Currency Field -->
<div class="col-sm-12">
    {!! Form::label('currency', 'Currency:') !!}
    <p>{{ $transaccion->currency }}</p>
</div>

<!-- Customerdata Fullname Field -->
<div class="col-sm-12">
    {!! Form::label('customerData_fullName', 'Customerdata Fullname:') !!}
    <p>{{ $transaccion->customerData_fullName }}</p>
</div>

<!-- Customerdata Phonenumber Field -->
<div class="col-sm-12">
    {!! Form::label('customerData_phoneNumber', 'Customerdata Phonenumber:') !!}
    <p>{{ $transaccion->customerData_phoneNumber }}</p>
</div>

<!-- Customeremail Field -->
<div class="col-sm-12">
    {!! Form::label('customerEmail', 'Customeremail:') !!}
    <p>{{ $transaccion->customerEmail }}</p>
</div>

<!-- Id Transaction Field -->
<div class="col-sm-12">
    {!! Form::label('id_transaction', 'Id Transaction:') !!}
    <p>{{ $transaccion->id_transaction }}</p>
</div>

<!-- Paymentmethod Extra Brand Field -->
<div class="col-sm-12">
    {!! Form::label('paymentMethod_extra_brand', 'Paymentmethod Extra Brand:') !!}
    <p>{{ $transaccion->paymentMethod_extra_brand }}</p>
</div>

<!-- Paymentmethod Extra Externalidentifier Field -->
<div class="col-sm-12">
    {!! Form::label('paymentMethod_extra_externalIdentifier', 'Paymentmethod Extra Externalidentifier:') !!}
    <p>{{ $transaccion->paymentMethod_extra_externalIdentifier }}</p>
</div>

<!-- Paymentmethod Extra Lastfour Field -->
<div class="col-sm-12">
    {!! Form::label('paymentMethod_extra_lastFour', 'Paymentmethod Extra Lastfour:') !!}
    <p>{{ $transaccion->paymentMethod_extra_lastFour }}</p>
</div>

<!-- Paymentmethod Extra Name Field -->
<div class="col-sm-12">
    {!! Form::label('paymentMethod_extra_name', 'Paymentmethod Extra Name:') !!}
    <p>{{ $transaccion->paymentMethod_extra_name }}</p>
</div>

<!-- Paymentmethod Installments Field -->
<div class="col-sm-12">
    {!! Form::label('paymentMethod_installments', 'Paymentmethod Installments:') !!}
    <p>{{ $transaccion->paymentMethod_installments }}</p>
</div>

<!-- Paymentmethod Type Field -->
<div class="col-sm-12">
    {!! Form::label('paymentMethod_type', 'Paymentmethod Type:') !!}
    <p>{{ $transaccion->paymentMethod_type }}</p>
</div>

<!-- Reference Field -->
<div class="col-sm-12">
    {!! Form::label('reference', 'Reference:') !!}
    <p>{{ $transaccion->reference }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $transaccion->status }}</p>
</div>

