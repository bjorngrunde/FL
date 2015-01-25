@extends('layouts.admin')

@section('content')
    <div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Raids</h3>
    </div>
     <div class="col-md-6">
           <ol class="breadcrumb">
            <li><a href="/admin">Admin Dashboard</a></li>
            <li class="active">Raids</li>
           </ol>
           </div>
           <div class="col-md-6">
            <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
           </div>
        <div class="col-md-12">
        <div class="col-sm-12">
            <ul class="list-unstyled list-inline">
                <li><a href="/admin/flrs/create" class="btn btn-primary btn-sm">Skapa en raid </a></li>
                <li><a href="/admin/flrs/add" class="btn btn-primary btn-sm">Skapa en Instans </a></li>
                <li><a href="/admin/flrs/instance" class="btn btn-primary btn-sm">Lista Instanser</a></li>
            </ul>
        </div>
            <table class="table hover">
                <tr>
                <th>Titel</th>
                <th>Datum</th>
                <th>Startar</th>
                <th>Slutar</th>
                <th>Typ</th>
                <th>Redigera</th>
                <th>Ta bort</th>
                </tr>
                <tbody>
                @foreach($raids as $raid)
                <tr>
                <td>{{$raid->title}}</td>
                <td>{{$raid->time}}</td>
                <td>{{$raid->startTime}}</td>
                <td>{{$raid->endTime}}</td>
                <td>{{$raid->mode}}</td>
                <td><a href="/admin/flrs/{{$raid->id}}/edit" class="btn btn-warning  btn-sm">Redigera </a></td>
                <td>{{Form::open(['method' => 'DELETE','route' => ['flrs.destroy', $raid->id]])}}
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

@stop