@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <img src="/img/login/logo.png" class="img-responsive center-block" />
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 text-center">
        <h4>Återställ ditt lösenord</h4>
        @if(Session::has('error'))
            <P class="text-danger">{{Session::get('error')}}</P>
        @elseif(Session::has('status'))
            <p class="text-success">{{Session::get('status')}}</p>
        @else
        <p>Skriv in ditt nya lösenord och du är klar!</p>
        @endif
    </div>
    <div class="col-md-12">
        {{Form::open()}}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group col-md-6 col-md-offset-3">
            {{Form::label('email', 'Email')}}
            {{Form::email('email', null, ['class' => 'form-control'])}}
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
            {{Form::label('password', 'Nytt lösenord')}}
            {{Form::password('password', ['class' => 'form-control'])}}
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
            {{Form::label('password_confirmation', 'Bekräfta nytt lösenord')}}
            {{Form::password('password_confirmation', ['class' => 'form-control'])}}
        </div>
        <div class="form-group col-md-6 col-md-offset-3 text-center">
            {{Form::submit('Återställ', ['class' => 'btn btn-primary btn-lg'])}}
        </div>
        {{Form::close()}}
    </div>
</div>
@stop