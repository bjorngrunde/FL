@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
        <div class="well well-lg">
        <div class="col-md-12">
            <h5 class="text-center">Evenemang</h5>
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