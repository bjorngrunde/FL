@extends('layouts.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="text-center">{{$post->title}}</h3>
             </div>
             <div class="panel-body">
             <ul class="list-unstyled list-inline text-center">
                 <li><p>Publicerad:<small> {{$post->created_at}}</small></p></li>
                 <li><p>Skriven av: <span class="{{$post->user->profile->klass}}">{{$post->user->username}}</span></p></li>
             </ul>
             <div class="col-md-12">
                    {{BBCode::setParser('image', '/\[img\](.*?)\[\/img\]/s)', '<img src="$1" class="img-responsive">')}}
                  {{BBCode::parse($post->body)}}
             </div>
             </div>
            </div>
        <div class="col-md-12">
             @include('laravel-comments::comments', ['commentable' => $post, 'comments' => $post->comments])
        </div>
            </div>
        </div>
@stop