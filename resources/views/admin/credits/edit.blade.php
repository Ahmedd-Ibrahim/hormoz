@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Credit
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($credit, ['route' => ['credits.update', $credit->id], 'method' => 'patch']) !!}

                        @include('admin.credits.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
