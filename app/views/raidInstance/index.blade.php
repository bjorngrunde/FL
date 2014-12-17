@extends('layouts.admin')

@section('content')
 <div class="row well well-lg">
    <div class="col-md-12">
        <h5>Instanser</h5>
        @if(Session::has('flash_message'))
            <p class="text-success">{{Session::get('flash_message')}}</p>
        @endif
        <table class="table hover">
            <tr>
                <th>Titel</th>
                <th>Bild</th>
                <th>Redigera</th>
                <th>Ta bort</th>
            </tr>
            <tbody>
            @foreach($raidInstance as $instance)
            <tr>
                <td>{{$instance->title}}</td>
                <td><img class="img-thumbnail table-img" src="{{$instance->backgroundImg}}" /> </td>
                <td><a href="/admin/flrs/instance/{{$instance->id}}/edit" class="btn btn-warning  btn-sm">Redigera </a></td>
                <td>{{Form::open(['method' => 'DELETE','route' => ['raids.destroy', $instance->id]])}}
                    {{Form::submit('Ta bort', ['class' => 'btn btn-danger btn-sm'])}}
                    {{Form::close()}}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
 </div>
 @stop