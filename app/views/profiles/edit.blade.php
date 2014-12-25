@extends('layouts.home')

@section('content')

<div class="row">
    <div class="col-md-12 text-center">
        <h4>Inställningar för:  <span class="{{$user->profile->klass}}"> {{$user->username}}</span></h4>
        @if(Session::has('flash_message'))
        <p class="text-success">{{Session::get('flash_message')}}</p>
        @endif
    </div>
    <div class="col-md-12">
        <ul class="nav nav-pills" role="tablist">
            <li class="active"><a href="#home" role="tab" data-toggle="tab">Information</a></li>
            <li><a href="#mail" role="tab" data-toggle="tab">Email</a></li>
            <li><a href="#password" role="tab" data-toggle="tab">Lösenord</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="col-md-6 col-md-offset-3">
                    {{Form::model($user->profile,['method'=>'PATCH','route' => ['profiles.update', $user->username ]])}}
                        <div class="form-group">
                            {{Form::label('name', 'Namn')}}
                            {{Form::text('name', null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('lastName', 'Efternamn')}}
                            {{Form::text('lastName', null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('phone', 'Telefon')}}
                            {{Form::text('phone', null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group text-center">
                        {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
                        </div>
                    {{Form::close()}}
                </div>
            </div>


            <div role="tabpanel" class="tab-pane fade" id="mail">
                {{Form::model($user,['method'=>'PATCH','route' => ['profiles.update', $user->username ]])}}
                <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    {{Form::label('email', 'Email')}}
                    {{Form::text('email', null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group text-center">
                    {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
                </div>
                </div>
                {{Form::close()}}
            </div>


            <div role="tabpanel" class="tab-pane fade" id="password">
            {{Form::open(['method'=>'PATCH', 'route' => ['profiles.update', $user->username ]]) }}
            <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                {{Form::label('password', 'Lösenord')}}
                {{Form::password('password', ['class' => 'form-control'])}}
                {{errors_for('password', $errors)}}
            </div>
            <div class="form-group">
                {{Form::label('password_confirmation', 'Bekräfta lösenord')}}
                {{Form::password('password_confirmation', ['class' => 'form-control'])}}
            </div>
            <div class="form-group text-center">
                {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
            </div>
            </div>
            {{Form::close()}}
            </div>

        </div>
    </div>
</div>

@stop