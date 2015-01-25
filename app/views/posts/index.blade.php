@extends('layouts.admin')

@section('content')
    <div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Nyheter</h3>
    </div>
     <div class="col-md-6">
           <ol class="breadcrumb">
            <li><a href="/admin">Admin Dashboard</a></li>
            <li class="active">Nyheter</li>
           </ol>
           </div>
           <div class="col-md-6">
            <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
           </div>
     <div class="col-md-12">
        <ul class="list-inline list-unstyled">
            <li><a href="/admin/posts/create" class="btn btn-primary btn-sm">Skapa en nyhet</a> </li>
        </ul>
     </div>
    <div class="col-sm-12">
    <div class="col-md-12">
        <table class="table">
            <tr>
                <th>Titel</th>
                <th>Författare</th>
                <th>Redigera</th>
                <th>Ta bort</th>
            </tr>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <th><p>{{$post->title}}</p></th>
                <th><p>{{$post->user->username}}</p></th>
                <th><a href="/admin/posts/{{$post->id}}/edit" class="btn btn-warning btn-sm">Redigera</a></th>
                <th>
                    {{Form::open(['method' => 'DELETE', 'route' =>['posts.destroy', $post->id]])}}
                    {{Form::submit('Ta bort', ['class' => 'btn btn-danger btn-sm'])}}
                    {{Form::close()}}
                </th>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
    </div>
@stop