<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $credit->id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $credit->user_id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $credit->name }}</p>
</div>

<!-- Number Field -->
<div class="form-group">
    {!! Form::label('number', 'Number:') !!}
    <p>{{ $credit->number }}</p>
</div>

<!-- Expire Date Field -->
<div class="form-group">
    {!! Form::label('expire_date', 'Expire Date:') !!}
    <p>{{ $credit->expire_date }}</p>
</div>

<!-- Cvv Field -->
<div class="form-group">
    {!! Form::label('cvv', 'Cvv:') !!}
    <p>{{ $credit->cvv }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $credit->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $credit->updated_at }}</p>
</div>

