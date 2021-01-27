@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mailing
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($mailing, ['route' => ['mailings.update', $mailing->id], 'method' => 'patch']) !!}

                        @include('admin.mailings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
