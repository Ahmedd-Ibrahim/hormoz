<!-- Vendor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vendor_id', 'Vendor Id:') !!}
    {!! Form::text('vendor_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::text('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Maxmim Stock For Client Field -->
<div class="form-group col-sm-6">
    {!! Form::label('maxmim_stock_for_client', 'Maxmim Stock For Client:') !!}
    {!! Form::text('maxmim_stock_for_client', null, ['class' => 'form-control']) !!}
</div>

<!-- Weight Field -->
<div class="form-group col-sm-6">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
</div>

<!-- Sku Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sku', 'Sku:') !!}
    {!! Form::text('sku', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control']) !!}
</div>

<!-- Regluar Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('regluar_price', 'Regluar Price:') !!}
    {!! Form::number('regluar_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Sale Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_sale', 'Is Sale:') !!}
    {!! Form::number('is_sale', null, ['class' => 'form-control']) !!}
</div>

<!-- Sale Precent Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sale_precent', 'Sale Precent:') !!}
    {!! Form::number('sale_precent', null, ['class' => 'form-control']) !!}
</div>

<!-- Sale Expire Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sale_expire_date', 'Sale Expire Date:') !!}
    {!! Form::text('sale_expire_date', null, ['class' => 'form-control','id'=>'sale_expire_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#sale_expire_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Catching Word Field -->
<div class="form-group col-sm-6">
    {!! Form::label('catching_word', 'Catching Word:') !!}
    {!! Form::text('catching_word', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Brand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand', 'Brand:') !!}
    {!! Form::text('brand', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
</div>
