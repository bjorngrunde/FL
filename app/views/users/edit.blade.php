@extends('layouts.admin')

@section('content')
<div class="row">
<div class="col-md-12 text-center">
    <h5>Redigera användaren: {{$user->username}}</h5>
    @if(Session::has('flash_message'))
        <p class="text-success">{{Session::get('flash_message')}}</p>
    @endif
</div>
    <div class="col-md-12">
        <ul class="nav nav-pills" role="tablist">
            <li class="active"><a href="#home" role="tab" data-toggle="tab">Profil</a></li>
            <li><a href="#mail" role="tab" data-toggle="tab">Email</a></li>
            <li><a href="#password" role="tab" data-toggle="tab">Lösenord</a></li>
            <li><a href="#role" role="tab" data-toggle="tab">Behörighet</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">

            {{Form::model($user->profile,['method' => 'PATCH', 'route' => ['users.update', $user->username]])}}

                <div class="form-group col-md-6">
                    {{Form::label('name', 'Förnamn')}}
                    {{Form::text('name', null, ['class' => 'form-control'])}}
                    {{errors_for('name', $errors)}}
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('lastName', 'Efternamn')}}
                    {{Form::text('lastName', null, ['class' => 'form-control'])}}
                    {{errors_for('lastName', $errors)}}
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('phone', 'Telefon')}}
                    {{Form::text('phone', null, ['class' => 'form-control'])}}
                    {{errors_for('phone', $errors)}}
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('klass', 'Klass', ['class' => 'text-white']) }}
                    {{ Form::select('klass',['death-knight' => 'Death Knight', 'druid' => 'Druid','hunter' => 'Hunter', 'mage'=>'Mage', 'monk' => 'Monk','priest' =>
                     'Priest','paladin' => 'Paladin', 'rogue' => 'Rogue', 'shaman' => 'Shaman','warlock' => 'Warlock', 'warrior' => 'Warrior' ],null,
                       ['class' => 'form-control', 'required' => 'required']) }}
                       {{errors_for('klass', $errors)}}
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('rank', 'Rank')}}
                    {{Form::select('rank', ['Trial' => 'Trial', 'Social' => 'Social', 'Raider' => 'Raider', 'Officer' => 'Officer', 'Guild Master' => 'Guild Master'], null, ['class' => 'form-control'])}}
                    {{errors_for('klass', $errors)}}
                </div>
                <div class="form-group col-md-12 text-center">
                    {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
                </div>

            {{Form::close()}}

          </div>
          <div role="tabpanel" class="tab-pane" id="mail">

                {{Form::model($user,['method' => 'PATCH', 'route' => ['users.update', $user->username]])}}

                    <div class="form-group col-md-6 col-lg-offset-3">
                        {{Form::label('email', 'Email')}}
                        {{Form::email('email', null, ['class' => 'form-control'])}}
                        {{errors_for('email', $errors)}}
                    </div>
                    <div class="form-group col-md-6 col-md-offset-3 text-center">
                        {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
                    </div>

                {{Form::close()}}
          </div>
          <div role="tabpanel" class="tab-pane " id="password">
            {{Form::open(['method' => 'PATCH', 'route' =>['users.update', $user->username]])}}
                <div class="form-group col-md-6 col-md-offset-3">
                    {{Form::label('password', 'Lösenord')}}
                    {{Form::password('password', ['class' => 'form-control'])}}
                    {{errors_for('password', $errors)}}
                </div>
                <div class="form-group col-md-6 col-md-offset-3">
                    {{Form::label('password_confirmation', 'Bekräfta lösenord')}}
                    {{Form::password('password_confirmation', ['class' => 'form-control'])}}
                </div>
                <div class="form-group col-md-6 col-md-offset-3 text-center">
                    {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
                </div>
            {{Form::close()}}
          </div>
            <div role="tabpanel" class="tab-pane fade" id="role">
                {{Form::open(['method' => 'PATCH', 'route' => ['users.update', $user->username]])}}
                <div class="col-md-6  col-md-offset-3">
                <div class="form-group">
                {{Form::label('role', 'Sätt en behörighet')}}
                {{Form::select('role', [5 => 'Bannad', 4 => 'Inaktiv', 3 => 'Medlem', 2 => 'Admin', 1 => 'Utvecklare'],null,['class' => 'form-control'])}}
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