<!-- Vendor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vendor_id', 'Vendor Id:') !!}
    {!! Form::select('vendor_id', \App\Models\Vendor::pluck('name','id'),null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::select('category_id', \App\Models\Category::pluck('name','id') ,null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_category_id', 'sub category Id:') !!}
    {!! Form::select('sub_category_id', \App\Models\SubCategory::pluck('name','id') ,null, ['class' => 'form-control']) !!}
</div>

<!-- Maximum Stock For Client Field -->
<div class="form-group col-sm-6">
    {!! Form::label('maximum_stock_for_client', 'Maximum Stock For Client:') !!}
    {!! Form::number('maximum_stock_for_client', null, ['class' => 'form-control']) !!}
</div>

<!-- Weight Field -->
<div class="form-group col-sm-6">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::number('weight', null, ['class' => 'form-control']) !!}
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

<!-- Regular Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('regular_price', 'Regular Price:') !!}
    {!! Form::number('regular_price', null, ['class' => 'form-control']) !!}
</div>


<!-- Sale Percent Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sale_percent', 'Sale Percent:') !!}
    {!! Form::number('sale_percent', null, ['class' => 'form-control']) !!}
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
    {!! Form::select('status',['active'=>'active','deactivate'=>'deactivate'] ,null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slide', 'slide:') !!}
    {!! Form::select('slide',['true'=>'true','false'=>'false'] ,null, ['class' => 'form-control']) !!}
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
