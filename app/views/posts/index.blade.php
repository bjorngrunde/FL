@extends('layouts.admin')

@section('content')
    <div class="row">
    <div class="col-sm-12 well well-lg">
    <div class="div col-md-12 text-center">
        <h5>Nyheter</h5>
        @if(Session::has('flash_message'))
           <p class="text-success"> {{Session::get('flash_message')}}</p>
       @endif
    </div>
    <div class="col-md-12">
        <table class="table">
            <tr>
                <th></th>
                <th>Titel</th>
                <th>Författare</th>
                <th>Redigera</th>
                <th>Ta bort</th>
            </tr>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <th><img class="img-thumbnail table-img" src="{{$post->thumbnail}}" /></th>
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