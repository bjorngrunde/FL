@extends('layouts.home')

@section('content')

<div class="row">
<div class="col-md-12">
    @if(Session::has('flash_message'))
        <p class="text-info">{{Session::get('flash_message')}}</p>
     @endif
     @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare') || $thread->author_id == Auth::user()->id)
     <div class="pull-right"><a id="{{$thread->id}}" href="#" class="btn btn-danger btn-xs delete_group" data-toggle="modal" data-target="#group_delete">Ta bort</a> </div>
     @endif
</div>
</div>
<div class="row">
<div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading">

            <h6>{{$thread->title}}</h6>

        </div>
        <div class="panel-body">
        <div class="col-sm-12">
        <div class="col-sm-4">
       <img src="{{$author->profile->thumbnail}}" class="img-circle img-responsive profile-img-avatar" />
       <p class="{{$author->profile->klass}}">{{$author->username}}</p>
        </div>
            <div class="col-sm-8">
             <p>{{$thread->body}}</p>
            </div>
            <hr class="divider" />
            </div>
        </div>
    </div>
</div>
</div>
@stop