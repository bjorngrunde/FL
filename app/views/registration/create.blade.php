@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h5 class="text-center">Skapa en användare</h5>
        @if(Session::has('flash_message'))
            <p class="text-success text-center">{{Session::get('flash_message')}}</p>
        @endif
    </div>
    {{Form::open(['route' => 'registration.store'])}}
    <div class="col-md-6">
        <div class="form-group">
        {{ Form::label('name', 'Förnamn') }}
        {{ Form::text('name', null,  ['class' => 'form-control']) }}
        {{ $errors->first('name', '<p class="text-warning">:message </p>') }}
        </div>
        </div>
    <div class="col-md-6">
        <div class="form-group">
        {{ Form::label('lastName', 'Efternamn', ['class' => 'text-white']) }}
        {{ Form::text('lastName', null,  ['class' => 'form-control', 'required' => 'required']) }}
        {{ $errors->first('lastName', '<p class="text-warning">:message </p>') }}
        </div>
     </div>
     <div class="col-md-6">
          <div class="form-group">
         {{Form::label('email', 'Email')}}
         {{Form::text('email', null, ['class' => 'form-control', 'required' => 'required'])}}
         {{ $errors->first('email', '<p class="text-warning">:message </p>') }}
         </div>
     </div>
     <div class="col-md-6">
        <div class="form-group">
        {{Form::label('username', 'Huvudkaraktär')}}
        {{Form::text('username', null, ['class' => 'form-control', 'required' => 'required'])}}
        {{ $errors->first('username', '<p class="text-warning">:message </p>') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        {{ Form::label('klass', 'Vilken klass?', ['class' => 'text-white']) }}
        {{ Form::select('klass',['death-knight' => 'Death Knight', 'druid' => 'Druid','hunter' => 'Hunter', 'mage'=>'Mage', 'monk' => 'Monk','priest' =>
         'Priest','paladin' => 'Paladin', 'rogue' => 'Rogue', 'shaman' => 'Shaman','warlock' => 'Warlock', 'warrior' => 'Warrior' ],'death-knight',
           ['class' => 'form-control', 'required' => 'required']) }}
        {{ $errors->first('klass', '<p class="text-warning">:message </p>') }}
        </div>
    </div>
    <div class="col-md-6">
         <div class="form-group">
        {{Form::label('rank', 'Sätt en rank.')}}
        {{Form::select('rank', ['Trial' => 'Trial', 'Social' => 'Social', 'Raider' => 'Raider', 'Officer' => 'Officer', 'Guild Master' => 'Guild Master'], 'Trial', ['class' => 'form-control'])}}
        {{ $errors->first('rank', '<p class="text-warning">:message </p>') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        {{ Form::label('role', 'Sätt en behörighet') }}
        {{ Form::select('role',['Utvecklare' => 'Utvecklare', 'Admin' => 'Admin','Medlem' => 'Medlem', 'Inaktiv'=>'Inaktiv', 'Bannad' => 'Bannad'],'',
           ['class' => 'form-control', 'required' => 'required']) }}
        {{ $errors->first('klass', '<p class="text-warning">:message </p>') }}
        </div>
        <div class="col-md-12">
        <div class="form-group text-center">
           {{Form::submit('Skapa Användare', ['class' => 'btn btn-primary btn-lg'])}}
           {{Form::close()}}
       </div>
   </div>
</div>
@stop