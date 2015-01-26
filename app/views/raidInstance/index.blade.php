@extends('layouts.admin')

@section('content')
 <div class="row">
 <div class="col-md-12">
         <h3 class="text-center">Instanser</h3>
     </div>
      <div class="col-md-6">
            <ol class="breadcrumb">
             <li><a href="/admin">Admin Dashboard</a></li>
             <li class="active">Instanser</li>
            </ol>
            </div>
            <div class="col-md-6">
             <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
            </div>
    <div class="col-sm-12">
        <ul class="list-unstyled list-inline">
            <li><a href="/admin/flrs/add" class="btn btn-primary btn-sm">Skapa en instans</a> </li>
            <li><a href="/admin/flrs/create"  class="btn btn-primary btn-sm">Skapa en raid</a> </li>
            <li><a href="/admin/flrs/index"  class="btn btn-primary btn-sm">Lista raids</a> </li>
        </ul>
    </div>
    <div class="col-md-12">
        <h5>Instanser</h5>
        @if(Session::has('flash_message'))
            <p class="text-success">{{Session::get('flash_message')}}</p>
        @endif
        <table class="table hover">
            <tr>
                <th>Titel</th>
                <th>Redigera</th>
                <th>Ta bort</th>
            </tr>
            <tbody>
            @foreach($raidInstance as $instance)
            <tr>
                <td>{{$instance->title}}</td>
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