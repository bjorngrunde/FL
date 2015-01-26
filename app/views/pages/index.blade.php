@extends('layouts.home')

@section('content')
<div class="row">
 @if(Session::has('flash_message'))
        <p class="text-success">{{Session::get('flash_message')}}</p>
    @endif
    <div class="col-md-8">
    <div class="col-md-12 text-center dark-sh-well-no-radius">
        <h3>Nyheter</h3>
    </div>
    <!-- Blog post -->
    @foreach($posts as $post)
    <div class="col-md-12 ">
    <div class="col-md-8 col-md-offset-4">
    <h4><a href="/news/post/{{$post->id}}">{{$post->title}}</a></h4>
    </div>
    @if(!empty($post->thumbnail))
        <div class="col-md-4">
            <img src="{{$post->thumbnail}}" class="img-responsive blog-post-img" />
        </div>
    @endif
        <div class="col-md-8">
            {{Str::limit($post->body, 200)}}
        </div>
        <div class="col-md-8 col-md-offset-4">
            <ul class="list-unstyled list-inline">
                <li><span class="fa-comment"></span> {{count($post->comments)}} Kommentarer</li>
                <li><p><span class="fa-calendar"></span> Skriven av: <span class="{{$post->user->profile->klass}}">{{$post->user->username}}</span></p></li>
            </ul>
        </div>
        </div>
    @endforeach
    <div class="col-md-12">
    {{$posts->links()}}
    </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12 text-center dark-sh-well-no-radius">
            <h3>Forum</h3>
        </div>
        <div class="col-md-12">
            @foreach($threads as $thread)
                @if(count($thread->comments) > 0 )
                  @foreach($thread->comments as $comment)
                    @if($comment->updated_at == $thread->updated_at)
                    <p>
                    <a href="/profile/{{$comment->author->username}}">
                    <span class="{{$comment->author->profile->klass}}">{{$comment->author->username}}</span></a>
                    har lämnat en kommentar på <a href="/forum/thread/{{$comment->thread_id}}">{{$thread->title}}</a>
                    </p>
                    @endif
                @endforeach
                @endif
                <p>
                <a href="/profile/{{$thread->author->username}}">
                <span class="{{$thread->author->profile->klass}}">{{$thread->author->username}}</span></a> skapade tråden <a href="/forum/thread/{{$thread->id}}">{{$thread->title}}</a>
                </p>

            @endforeach
        </div>

        <div class="col-md-12 text-center dark-sh-well-no-radius">
            <h3>Datum</h3>
        </div>
         @foreach($raids as $raid)
         <a href="flrs/show/{{$raid->id}}" class="raid-timer-link">
        <div class="col-md-12 dark-sh-well-no-radius" style="background:url({{$raid->backgroundImg}}) no-repeat center center; background-size: cover;">

            <div class="col-md-5">
                <p class="text-white">{{$raid->time}}</p>
            </div>
            <div class="col-md-7">
                <p class="text-white">{{$raid->title}} <small>{{$raid->mode}}</small></p>
            </div>
            <hr class="divider-invisible" />
        </div>
        </a>
        @endforeach
    </div>
</div>
@stop