@extends('layouts.home')

@section('content')
    <div class="row">
    @if(Session::has('flash_message'))
        <p class="text-success">{{Session::get('flash_message')}}</p>
    @endif
    <div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title">Nyheter</h3>
        </div>
        <div class="panel-body">
 <!-- Blog post -->
    @foreach($posts as $post)
    <div class="col-sm-4">
        <h4><a href="/news/post/{{$post->id}}">{{$post->title}}</a></h4>
       {{Str::limit(strip_tags($post->body), 100)}}
       <br/>
       <br/>
      <small><span class="glyphicon glyphicon-comment"></span> {{count($post->comments)}} st </small>
       <small><span class="glyphicon glyphicon-calendar"></span> {{ $post->created_at->format('Y/m/d') }}</small>
       <br />
       <p>Av: <span class="{{$post->user->profile->klass}}">{{$post->user->username}}</span></p>
        </div>

    @endforeach
    <div class="col-md-12">
    {{$posts->links()}}
    </div>
        </div>
   </div>
   <div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Galleri</h4>
    </div>
        <div class="panel-body">
            @foreach($photos as $photo)
            <div class="col-md-4 margin-bot-img">
                <img src="{{asset('uploads/thumbnails/'.$photo->thumbnail)}}" class="img-responsive dark-sh-well-no-radius-img" />
                <a href="/gallery/album/{{$photo->album_id.'/photo/'.$photo->photo_id}}"><h5>{{$photo->photo_name}}</h5></a>
                <small>Album: <a href="/gallery/album/{{$photo->album_id}}">{{$photo->album->album_name}}</a> </small>
                <br />
                <small>Ägare: <span class="{{$photo->user->profile->klass}}">  {{$photo->user->username}} </span></small>
            </div>
            @endforeach
        </div>
    </div>

   </div>
    <div class="col-md-4">
    <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Kommande Raids</h3>
    </div>
    <div class="panel-body">
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

       <div class="panel panel-default">
       <div class="panel-heading">
            <h3 class="panel-title">Forumaktivitet</h3>
            </div>
        <div class="panel-body">
        <div class="col-md-12">
          @foreach($threads as $thread)
              @if(count($thread->comments) > 0 )
                @foreach($thread->comments as $comment)
                  @if($comment->updated_at == $thread->updated_at)
                  @if(Auth::user()->profile->forum_rank <= $comment->group->rank)
                  <p>
                  <a href="/profile/{{$comment->author->username}}">
                  <span class="{{$comment->author->profile->klass}}">{{$comment->author->username}}</span></a>
                  har lämnat en kommentar på <a href="/forum/thread/{{$comment->thread_id}}">{{$thread->title}}</a>
                  </p>
                  @endif
                  @endif
              @endforeach
              @endif
               @if(Auth::user()->profile->forum_rank <= $thread->group->rank)
              <p>
              <a href="/profile/{{$thread->author->username}}">
              <span class="{{$thread->author->profile->klass}}">{{$thread->author->username}}</span></a> skapade tråden <a href="/forum/thread/{{$thread->id}}">{{$thread->title}}</a>
              </p>
              @endif
          @endforeach
      </div>
    </div>
</div>
    </div>
</div>
@stop