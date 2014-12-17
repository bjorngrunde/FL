@extends('layouts.admin')

@section('content')
<div class="row well well-lg">
<div class="col-md-12">
    <h4>Skapa ett evenemang!</h4>
    @if(Session::has('flash_message'))
        <p class="text-success">{{Session::get('flash_message')}}</p>
    @endif
    <div class="col-sm-8 col-md-8">
        {{Form::open(['route' => 'flrs.store'])}}
        <div class="form-group">
        {{Form::label('title', 'Titel')}}
        <select class="form-control" name="id">
        @foreach($raids as $raid)
        <option value="{{ $raid->id}}">{{$raid->title}}</option>
        @endforeach
        </select>
        {{errors_for('title', $errors)}}
        </div>
        <div class="form-group">
        {{Form::label('description', 'Beskrivning')}}
        {{Form::textarea('description', null, ['class' => 'form-control'])}}
        {{errors_for('description', $errors)}}
        </div>
        <div class="form-group form-horizontal">

        {{Form::radio('mode', 'Normal', true)}}
        {{Form::label('mode1', 'Normal')}}
        {{Form::radio('mode', 'Heroic')}}
        {{Form::label('mode2', 'Heroic')}}
        {{Form::radio('mode', 'Mythic')}}
         {{Form::label('mode3', 'Mythic')}}
        </div>
        </div>
        <div class="col-sm-2 col-md-2">
        <div class="form-group">
        {{Form::label('time', 'Datum')}}
        {{Form::text('time', null, ['class' => 'datum form-control'])}}
        {{errors_for('time', $errors)}}
        </div>

        <div class="form-group">
        {{Form::label('startTime', 'Starttid')}}
        {{Form::text('startTime', null, ['class' => 'startTid form-control'])}}
        {{errors_for('startTime', $errors)}}
        </div>

        <div class="form-group">
        {{Form::label('endTime', 'Sluttid')}}
        {{Form::text('endTime', null, ['class' => 'slutTid form-control'])}}
        {{errors_for('endTime', $errors)}}
        </div>
        </div>
        <div class="col-sm-12 col-md-12">
        <div class="form-group">
        {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
        </div>
        </div>
        {{Form::close()}}
     </div>
</div>

@stop