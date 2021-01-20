<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Is Primary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_primary', 'Is Primary:') !!}
    {!! Form::select('is_primary', ['true'=>'true','false'=>'false'],null, ['class' => 'form-control']) !!}
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::select('product_id',\App\Models\Product::pluck('name','id') ,null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('galleries.index') }}" class="btn btn-default">Cancel</a>
</div>
