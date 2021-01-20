<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $user->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {{ Form::label('name',__('users.name:'),[],false) }}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {{ Form::label('email',__('users.email:'),[],false) }}
    <p>{{ $user->email }}</p>
</div>
<!-- phone Field -->
<div class="form-group">
    {{ Form::label('phone',__('users.phone:'),[],false) }}
    <p>{{ $user->phone }}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {{ Form::label('email_verified_at',__('users.Email Verified At:'),[],false) }}
    <p>{{ $user->email_verified_at }}</p>
</div>

<!-- Remember Token Field -->
{{--<div class="form-group">--}}
{{--    {!! Form::label('remember_token', 'Remember Token:') !!}--}}
{{--    <p>{{ $user->remember_token }}</p>--}}
{{--</div>--}}

<!-- Role Field -->
<div class="form-group">
    {{ Form::label('role',__('users.role:'),[],false) }}
    <p>{{ $user->role }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {{ Form::label('created_at',__('users.created_at:'),[],false) }}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {{ Form::label('updated_at',__('users.updated_at:'),[],false) }}
    <p>{{ $user->updated_at }}</p>
</div>

