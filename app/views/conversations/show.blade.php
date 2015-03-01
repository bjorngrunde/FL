@extends('layouts.home')

@section('css')
<link href="/js/scrollbar/perfect-scrollbar.min.css" rel="stylesheet" />
<style>
#scrollbar {
    position: relative;
    height: 500px;
    overflow: hidden;
}
</style>
@stop
@section('content')

<div class="row">
<div class="col-sm-12">
    <ul class="list-inline list-unstyled">
        <li><a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_member">Lägg till fler personer</a> </li>
        <li><a href="/conversations/create" class="btn btn-primary btn-sm">Skapa ny konversation</a> </li>
        <li><a id="{{$conversation->id}}" href="#" class="btn btn-danger btn-sm leave_chat" data-toggle="modal" data-target="#leave_chat">Lämna denna konversation</a></li>
    </ul>
</div>
    <div class="col-sm-8">
    @if(Session::has('flash_message'))
        <h5 class="text-center text-primary">{{Session::get('flash_message')}}</h5>
    @endif
    <h4 class="text-center">Senaste Konversation</h4>
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h4 class=" text-primary">{{$conversation->subject}}</h4>
            </div>
            <div class="panel-body">
            <div id="scrollbar">
                @foreach($conversation->messages as $index => $message)
                    @if($message->user_id == Auth::user()->id)
                    <div class="row">
                    <div class="col-sm-7 col-sm-offset-2 dark-sh-well-no-radius text-right">
                        <p>{{$message->body}}</p>
                        <small class="small-grey">{{$message->created_at->format('y-m-d H:i:s')}}</small>
                    </div>
                     <div class="col-sm-2 text-center">
                    <img src="{{$message->user->profile->thumbnail}}" class="img-responsive img-nav img-circle center-block" />
                    <p><a href="/profile/{{$message->user->username}}"><span class="{{$message->user->profile->klass}}">{{$message->user->username}}</span></a></p>
                    @if($index+1 == count($conversation->messages))
                    <div id="last"></div>
                    @endif
                    </div>
                    </div>
                    @else
                    <div class="row">
                    <div class="col-sm-2 text-center">
                    <img src="{{$message->user->profile->thumbnail}}" class="img-responsive img-nav img-circle center-block" />
                    <p><a href="/profile/{{$message->user->username}}"><span class="{{$message->user->profile->klass}}">{{$message->user->username}}</span></a></p>
                    </div>
                    <div class="col-sm-7 dark-sh-well-no-radius">
                    <p>{{$message->body}}</p>
                    <small class="small-grey">{{$message->created_at->format('y-m-d H:i:s')}}</small>
                    @if($index+1 == count($conversation->messages))
                    <div id="last"></div>
                    @endif
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
            <h5><a href="/conversations/show/{{$chat->id}}"> {{$chat->subject}}</a>
            @foreach($newMessages as $message)
              @if($message->id == $chat->id)
              <span class="badge">Nya meddelanden</span>
              @endif
               @endforeach</h5>
             <ul class="list-unstyled list-inline">
            @foreach($chat->participants as $participant)
                <li><small><a href="/profile/{{$participant->user->username}}"> <span class="{{$participant->user->profile->klass}}">{{$participant->user->username}}</span> </a></small></li>
            @endforeach
            </ul>
        </div>
    @endforeach
    <div class="col-sm-12 text-center">
        {{$conversations->links()}}
    </div>
    </div>
</div>

<div class="modal fade" id="add_member" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Lägg till personer</h4>
            </div>
            <div class="modal-body">
               {{Form::open(['method' => 'POST', 'route' =>['conversation.add.member', $conversation->id], 'id' => 'target_add_member'])}}
                  <div class="form-group">
                  {{Form::label('recipient', 'Mottagare')}}
                  {{Form::text('recipient', null, ['class' => 'form-control tm-input tm-input-info tm-input-small', 'id' => 'sender', 'placeholder' => 'Välj mottagare'])}}
                  </div>
                  {{Form::close()}}
                  </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Stäng</button>
                <a id="btn_add_member" class="btn btn-primary btn-sm">Spara</a>
            </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="leave_chat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Lämna konversation</h4>
                </div>
                <div class="modal-body">
                    <p>Är du säker på att du vill lämna denna konversation?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Nej</button>
                    <a id="btn_leave_chat" class="btn btn-primary btn-sm">Lämna</a>
                </div>
            </div>
        </div>
    </div>


@stop
@section('javascript')

<script src="/js/scrollbar/perfect-scrollbar.min.js"></script>
<script src="/js/tags/tagmanager.js"></script>
<script>
    $(function() {
    $('#scrollbar').perfectScrollbar({
        suppressScrollX: true
    });
    $('#scrollbar').animate({ scrollTop:$('#last').offset().top }, "fast");
  return false
});

</script>
<script>
    $('#sender').autocomplete({
        source: '/query',
        minLength: 2
    });
   </script>
   <script>
       jQuery(".tm-input").tagsManager();
   </script>

@stop