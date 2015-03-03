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
     <ul class="list-inline list-unstyled">
     <li>
     <div class="btn-group" role="group" aria-label="...">
     @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare') || $thread->author_id == Auth::user()->id)
     <a type="button" href="/forum/thread/edit/{{$thread->id}}" class="btn btn-primary btn-sm"><span class="fa fa-edit fa-2x"></span> </a>
     <button type="button" id="{{$thread->id}}" href="#" class="btn btn-primary btn-sm delete_thread" data-toggle="modal" data-target="#thread_delete"><span class="fa fa-trash-o fa-2x"></span> </button>
     @endif
     </div>
     </li>
     <li><div class="btn-group" role="group" aria-label="...">
     @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
     <button type="button" id="" href="#" class="btn btn-primary btn-sm move_thread" data-toggle="modal" data-target="#thread_move"><span class="fa fa-arrows fa-2x"></span> </button>
     <button type="button" id="" href="#" class="btn btn-primary btn-sm copy_thread" data-toggle="modal" data-target="#thread_copy"><span class="fa fa-copy fa-2x"></span></button>
      </div>
      </li>
      <li>
      {{Form::open(['method' => 'POST', 'route' => ['forum.set.sticky', $thread->id] ])}}
      <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-thumb-tack fa-2x"></span> </button>
      {{Form::close()}}
      <li>
     @if($thread->locked->locked != 1)
     {{Form::open(['method' => 'POST', 'route' => ['thread.lock', $thread->id]])}}
     <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-lock fa-2x"></span> </button>
     {{Form::close()}}
     @else
     {{Form::open(['method' => 'POST', 'route' => ['thread.unlock', $thread->id]])}}
      <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-unlock fa-2x"></span> </button>
     {{Form::close()}}
     @endif
     @endif
     </li>
    </ul>
     @if($thread->locked->locked != 1)
     <ul class="list-inline list-unstyled pull-right">
     <li><a href="#" data-toggle="modal" data-target="#comment_form" class="btn btn-primary btn-sm ">Svara på tråd</a></li>
     <li><a href="#" data-toggle="modal" data-target="#comment_quote_form" class="btn btn-primary btn-sm ">Citat</a></li>
     </ul>
     @endif
</div>
</div>
<div class="row">
<div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading">
            <h3> @if($thread->locked->locked == 1)<span class="fa fa-lock"></span>@endif @if($thread->sticky->isSticky == 1) <span class="fa fa-thumb-tack"></span>@endif  {{$thread->title}}</h3>
        </div>
        <div class="panel-body dark-sh-well-no-radius">
        <div class="col-sm-12">
        <div class="col-sm-2 text-center">
       <img src="{{$thread->author->profile->thumbnail}}" class="img-circle img-responsive profile-img-avatar center-block" />
       <a href="/profile/{{$thread->author->username}}"><p class="{{$thread->author->profile->klass}}">{{$thread->author->username}}</p></a>
       <small>Rank: {{$thread->author->profile->rank}}</small>
     <br /><small>Inlägg: {{count($thread->author->threads) + count($thread->author->comments)}}</small>
     <br /> <br /><small>{{$thread->created_at}}</small>
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
    @if($thread->locked->locked != 1)
    <div class="col-sm-12">
        @foreach($comments as $comment)
            <div class="col-sm-12 dark-sh-well-no-radius">
            <div class="col-sm-12">
             <ul class="list-inline list-unstyled pull-right">
                <li><a href="#" data-toggle="modal" data-target="#comment-quote"><span id="{{$comment->id}}" class="fa fa-quote-left delete-comment"></span></a></li>
             @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare') || Auth::user()->username == $comment->author->username)
                <li><a href="#"  data-toggle="modal" data-target="#comment-edit"><span id="{{$comment->id}}" class="fa fa-pencil delete_comment"></span></a></li>
                <li><a href="#"  data-toggle="modal" data-target="#comment-delete"><span id="{{$comment->id}}" class="fa fa-times delete_comment"></span></a></li>
            @endif
             </ul>
            </div>
            <div class="col-sm-2 text-center">
             <img src="{{$comment->author->profile->thumbnail}}" class="img-circle img-responsive profile-img-avatar center-block" />
             <a href="/profile/{{$comment->author->username}}"><p class="{{$comment->author->profile->klass}}">{{$comment->author->username}}</p></a>
             <small>Rank: {{$comment->author->profile->rank}}</small>
              <br /><small>Inlägg: {{count($comment->author->comments) + count($comment->author->threads)}}</small>
              <br /><br /><small>{{$comment->created_at}}</small>

            </div>
            <div class="col-sm-10">

                <p>{{ BBCode::parse($comment->body) }}</p>

            </div>
            </div>
        @endforeach
       <ul class="list-inline list-unstyled pull-right">
        <li><a href="#" data-toggle="modal" data-target="#comment_form" class="btn btn-primary btn-sm ">Svara på tråd</a></li>
        <li><a href="#" data-toggle="modal" data-target="#comment_quote_form" class="btn btn-primary btn-sm ">Citat</a></li>
        </ul>
    </div>

    <div class="col-sm-12 text-center">
    {{$comments->links()}}
    </div>
    @else
    <div class="col-md-12">
    <div class="col-sm-12 dark-sh-well-no-radius text-center">
        <h4>Tråden är låst. Du kan inte kommentera!</h4>
    </div>
    </div>
    @endif
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

                            {{Form::textarea('body', null, ['class' => 'form-control',])}}
                            </div>
                            {{Form::close()}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal">Stäng</button>
                            <button type="button" class=" btn btn-primary btn-sm" data-dismiss="modal" id="form_comment_submit">Spara</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="comment_quote_form" tabindex="-1" role="dialog" aria-hidden="true">
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
                            {{Form::open(['method' => 'post', 'route' => ['forum-store-comment', $thread->id],'id' => 'target_comment_quote_form'])}}
                            <div class="form-group">

                            {{Form::textarea('body', '[quote]"'.BBcode::parse(strip_tags($thread->body)).'" -@'.$thread->author->username.'[/quote]', ['class' => 'form-control',])}}
                            </div>
                            {{Form::close()}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal">Stäng</button>
                            <button type="button" class=" btn btn-primary btn-sm" data-dismiss="modal" id="form_comment_quote_submit">Spara</button>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare') || Auth::user()->username == $comment->author->username)
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
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Stäng</button>
                                            <a id="btn_delete_comment" class="btn btn-primary btn-sm">Ta bort</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                         @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
                            <div class="modal fade" id="thread_move" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title">Flytta tråd</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{Form::open(['method' => 'post', 'route' => ['thread.move', $thread->id], 'id' => 'target_move_form'])}}
                                            <div class="form-group">
                                            {{Form::label('categories', 'Välj vart du ska flytta tråden')}}
                                            <select name="categories" class="form-control">
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                            {{Form::close()}}
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Stäng</button>
                                            <a id="btn_thread_move" class="btn btn-primary btn-sm">Flytta</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                         @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
                            <div class="modal fade" id="thread_copy" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title">Kopiera tråd</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{Form::open(['method' => 'post', 'route' => ['thread.copy', $thread->id], 'id' => 'target_copy_form'])}}
                                            <div class="form-group">
                                            {{Form::label('categories', 'Välj vart du ska kopiera tråden')}}
                                            <select name="categories" class="form-control">
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                            {{Form::close()}}
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Stäng</button>
                                            <a id="btn_thread_copy" class="btn btn-primary btn-sm">Kopiera</a>
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
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Stäng</button>
                                            <a id="btn_delete_thread" class="btn btn-primary btn-sm">Ta bort</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
@stop
@section('javascript')
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@stop