<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id',\App\User::pluck('name','id') ,null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', 'Number:') !!}
    {!! Form::number('number', null, ['class' => 'form-control']) !!}
</div>

<!-- Expire Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expire_date', 'Expire Date:') !!}
    {!! Form::text('expire_date', null, ['class' => 'form-control','id'=>'expire_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#expire_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Cvv Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cvv', 'Cvv:') !!}
    {!! Form::text('cvv', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('credits.index') }}" class="btn btn-default">Cancel</a>
</div>
