@extends('layouts.home')

@section('content')

<div class="row">
<div class="col-md-12">
<ol class="breadcrumb">
    <li><a href="/forum">Forum</a></li>
    <li><a href="/forum/category/{{$thread->category_id}}">{{$thread->category->title}}</a> </li>
    <li class="active">{{$thread->title}}</li>
</ol>
    @if(Session::has('flash_message'))
        <p class="text-info text-center">{{Session::get('flash_message')}}</p>
     @endif

     @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare') || $thread->author_id == Auth::user()->id)
     <a href="/forum/thread/edit/{{$thread->id}}" class="btn btn-warning btn-sm">Redigera tråd</a>
     <a id="{{$thread->id}}" href="#" class="btn btn-danger btn-sm delete_thread" data-toggle="modal" data-target="#thread_delete">Ta bort</a>
     @endif
     <a href="#" data-toggle="modal" data-target="#comment_form" class="btn btn-primary btn-sm pull-right">Svara på tråd</a>
</div>
</div>
<div class="row">
<div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading">

            <h6>{{$thread->title}}</h6>


        </div>
        <div class="panel-body dark-sh-well-no-radius">
        <div class="col-sm-12">
        <div class="col-sm-2 text-center">
       <img src="{{$thread->author->profile->thumbnail}}" class="img-circle img-responsive profile-img-avatar center-block" />
       <p class="{{$thread->author->profile->klass}}">{{$thread->author->username}}</p>
       <small>Rank: {{$thread->author->profile->rank}}</small>
     <br /><small>Inlägg: {{count($thread->author->threads) + count($thread->author->comments)}}</small>
        </div>
            <div class="col-sm-10">

             <p>{{BBCode::parse($thread->body)}}</p>
            </div>
            <div class="col-sm-12">

            </div>
            <hr class="divider" />
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-sm-12">
        @foreach($comments as $comment)
            <div class="col-sm-12 dark-sh-well-no-radius">
            <div class="col-sm-12">
             @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
                <a href="#" class="pull-right" data-toggle="modal" data-target="#comment-delete"><span id="{{$comment->id}}" class="fui-cross delete_comment"></span></a>
            @endif
            </div>
            <div class="col-sm-2 text-center">
             <img src="{{$comment->author->profile->thumbnail}}" class="img-circle img-responsive profile-img-avatar center-block" />
             <p class="{{$comment->author->profile->klass}}">{{$comment->author->username}}</p>
             <small>Rank: {{$comment->author->profile->rank}}</small>
              <br /><small>Inlägg: {{count($comment->author->comments) + count($comment->author->threads)}}</small>

            </div>
            <div class="col-sm-10">

                <p>{{ BBCode::parse($comment->body) }}</p>
            </div>
            </div>
        @endforeach
        <a href="#" data-toggle="modal" data-target="#comment_form" class="btn btn-primary btn-sm pull-right">Svara på tråd</a>
    </div>

    <div class="col-sm-12 text-center">
    {{$comments->links()}}
    </div>
</div>

 <div class="modal fade" id="comment_form" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Kommentera</h4>
                        </div>
                        <div class="modal-body">
                        <p> <small>Använd BBcode för att lägga in bilder, tex: <span class="text-info">[img] </span>länk<span class="text-info">[/img]</span> <br /> Använd ren syntax, tex:<span class="text-info"> [url]</span> www.familylegion.se <span class="text-info">[/url]</span> istället för <span class="text-info">[url=familylegion.com]</small>
</p>
                            {{Form::open(['method' => 'post', 'route' => ['forum-store-comment', $thread->id],'id' => 'target_comment_form'])}}
                            <div class="form-group">

                            {{Form::textarea('body', null, ['class' => 'form-control'])}}
                            </div>
                            {{Form::close()}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" btn btn-danger" data-dismiss="modal">Stäng</button>
                            <button type="button" class=" btn btn-primary" data-dismiss="modal" id="form_comment_submit">Spara</button>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
                            <div class="modal fade" id="comment-delete" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title">Ta bort kommentar</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Är du säker på att du vill ta bort denna kommentar?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Stäng</button>
                                            <a id="btn_delete_comment" class="btn btn-primary">Ta bort</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
                            <div class="modal fade" id="thread_delete" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title">Ta bort tråd.</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Är du säker på att du vill ta bort denna tråd?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Stäng</button>
                                            <a id="btn_delete_thread" class="btn btn-primary">Ta bort</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
@stop
@section('javascript')
<script src="/js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({selector:'textarea',
              plugins: 'bbcode'});
</script>
<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@stop