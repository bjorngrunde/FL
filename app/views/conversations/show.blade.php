@extends('layouts.home')

@section('css')
<link href="/js/scrollbar/perfect-scrollbar.min.css" rel="stylesheet" />
<style>
#scrollbar {
    position: relative;
    height: 500px; /* Or whatever you want (eg. 400px) */
    overflow: hidden;
}
</style>
@stop
@section('content')

<div class="row">
<div class="col-sm-12">
    <ul class="list-inline list-unstyled">
        <li><a href="" class="btn btn-primary btn-sm">Lägg till fler personer</a> </li>
        <li><a href="" class="btn btn-primary btn-sm">Skapa ny konversation</a> </li>
    </ul>
</div>
    <div class="col-sm-8">
    <h4 class="text-center">Senaste Konversation</h4>
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h4>{{$conversation->subject}}</h4>
            </div>
            <div class="panel-body">
            <div id="scrollbar">
                @foreach($conversation->messages as $message)
                    @if($message->user_id == Auth::user()->id)
                    <div class="row">
                    <div class="col-sm-7 col-sm-offset-2 dark-sh-well-no-radius text-right">
                        <p>{{$message->body}}</p>
                        <small class="small-grey">{{$message->created_at->format('y-m-d H:i:s')}}</small>
                    </div>
                     <div class="col-sm-2 text-center">
                    <img src="{{$message->user->profile->thumbnail}}" class="img-responsive img-nav img-circle center-block" />
                    <p><span class="{{$message->user->profile->klass}}">{{$message->user->username}}</span></p>
                    </div>
                    </div>
                    @else
                    <div class="row">
                    <div class="col-sm-2 text-center">
                    <img src="{{$message->user->profile->thumbnail}}" class="img-responsive img-nav img-circle center-block" />
                    <p><span class="{{$message->user->profile->klass}}">{{$message->user->username}}</span></p>
                    </div>
                    <div class="col-sm-7 dark-sh-well-no-radius">
                    <p>{{$message->body}}</p>
                    <small class="small-grey">{{$message->created_at->format('y-m-d H:i:s')}}</small>
                    </div>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <h5 class="text-center">Skicka meddelande</h5>
            {{Form::open(['method' => 'POST', 'route' =>['message.store', $conversation->id]])}}
            <div class="form-group">
            {{Form::textarea('message', null,['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
            {{Form::submit('Skicka', ['class' => 'btn btn-primary btn-sm pull-right'])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
    <div class="col-sm-4">
    <h4 class="text-center">Tidigare Konversationer</h4>
    @foreach($conversations as $chat)
        <div class="col-md-12 dark-sh-well-no-radius text-center">
            <h5><a href="/conversations/show/{{$chat->id}}"> {{$chat->subject}}</a></h5>
             <ul class="list-unstyled list-inline">
            @foreach($chat->participants as $participant)
                <li><small><span class="{{$participant->user->profile->klass}}">{{$participant->user->username}}</span> </small></li>
            @endforeach
            </ul>
        </div>
    @endforeach
    </div>
</div>


@stop
@section('javascript')

<script src="/js/scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $(function() {
    $('#scrollbar').perfectScrollbar({
        suppressScrollX: true
    });
    $('#scrollbar').animate({ scrollTop: $('#scrollbar').height() + $(document).height() }, "fast");
  return false
});

</script>
@stop