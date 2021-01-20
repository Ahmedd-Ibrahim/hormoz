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
                    {!! Form::open(['route' => 'credits.store']) !!}

                        @include('admin.credits.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
