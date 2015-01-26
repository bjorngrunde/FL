@extends('layouts.admin')

@section('content')

<div class="row">
<div class="col-md-12">
        <h3 class="text-center">Redigera raid</h3>
    </div>
     <div class="col-md-6">
           <ol class="breadcrumb">
            <li><a href="/admin">Admin Dashboard</a></li>
            <li><a href="/admin/flrs/index">Raids</a></li>
            <li class="active">Redigera Raid</li>
           </ol>
           </div>
           <div class="col-md-6">
            <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
           </div>
</div>
<div class="row">
    <div class="col-sm-8 col-md-8">
        {{Form::model($raid,['method' => 'PATCH','route' =>[ 'flrs.update', $raid->id]])}}
        <div class="form-group">
        {{Form::label('title', 'Titel')}}
        {{Form::text('title', null, ['class' => 'form-control'])}}
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
        {{Form::text('time', null, ['class' => 'datum form-control text-info'])}}
        {{errors_for('time', $errors)}}
        </div>

        <div class="form-group">
        {{Form::label('startTime', 'Starttid')}}
        {{Form::text('startTime', null, ['class' => 'startTid form-control text-info'])}}
        {{errors_for('startTime', $errors)}}
        </div>

        <div class="form-group">
        {{Form::label('endTime', 'Sluttid')}}
        {{Form::text('endTime', null, ['class' => 'slutTid form-control text-info'])}}
        {{errors_for('endTime', $errors)}}
        </div>
        </div>
        <div class="col-sm-12 col-md-12">
        <div class="form-group">
        {{Form::submit('Spara', ['class' => 'btn btn-primary btn-sm'])}}
        </div>

        {{Form::close()}}
    </div>
    <div class="col-sm-12">
    <h5 class="text-center">Kommentarer för detta evenemang</h5>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Användare</th>
                <th>Kommentar</th>
                <th>Ta bort</th>
            </tr>
            <tbody>
            @foreach($raid->comments as $comment)
            <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->user->username}}</td>
                <td>{{$comment->comment}}</td>
                <td>{{Form::open(['method' => 'DELETE', 'route' => ['delete-comment', $comment->id]])}}
                    {{Form::submit('Ta bort', ['class' => 'btn btn-danger btn-sm'])}}
                    {{Form::close()}}
                </td>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
     </div>
</div>


@stop