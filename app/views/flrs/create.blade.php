@extends('layouts.admin')

@section('content')
<div class="row">
 <div class="col-md-12">
        <h3 class="text-center">Skapa en raid</h3>
    </div>
     <div class="col-md-6">
           <ol class="breadcrumb">
            <li><a href="/admin">Admin Dashboard</a></li>
            <li><a href="/admin/flrs/index">Raids</a></li>
            <li class="active">Skapa Raid</li>
           </ol>
           </div>
           <div class="col-md-6">
            <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
           </div>
    <div class="col-md-12">
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
        {{Form::text('startTime', '19:30', ['class' => 'startTid form-control'])}}
        {{errors_for('startTime', $errors)}}
        </div>

        <div class="form-group">
        {{Form::label('endTime', 'Sluttid')}}
        {{Form::text('endTime', '23:00', ['class' => 'slutTid form-control'])}}
        {{errors_for('endTime', $errors)}}
        </div>
        </div>
        <div class="col-sm-12 col-md-12">
        <div class="form-group">
        {{Form::submit('Spara', ['class' => 'btn btn-primary btn-sm'])}}
        </div>
        </div>
        {{Form::close()}}
     </div>
</div>

@stop