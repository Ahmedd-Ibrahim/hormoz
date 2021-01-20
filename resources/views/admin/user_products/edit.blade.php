@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Product
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userProduct, ['route' => ['userProducts.update', $userProduct->id], 'method' => 'patch']) !!}

                        @include('admin.user_products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
