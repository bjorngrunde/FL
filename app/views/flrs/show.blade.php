@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-md-12 raid-title-with-desc" style="background:url({{$raid->backgroundImg}}) no-repeat center center; background-size: cover;">
    <div class="col-sm-8">
        <h2> <small>{{$raid->mode}}</small><br />{{$raid->title}}</h2>
        <p>{{$raid->description}}</p>
        <p>{{$datum[2] .' '. $datum[1] . ' ' . $datum[0]}}</p>
        <p><strong>{{$raid->startTime}}</strong>
         - <strong> {{$raid->endTime}} </strong>   </p>
         @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
            @if(count($raid->users) > 0)

        <a href="/admin/create/{{$raid->id}}/raidgroup" class="btn btn-danger btn-sm">Skapa Raidgrupp</a>

            @endif
        @endif
    </div>
    <div class="col-sm-4">

    </div>
    </div>
    <div class="col-sm-12">
    <hr class="divider-invisible" />
    @if(Session::has('flash_message'))
        <div class="text-center text-info">
            <P>{{Session::get('flash_message')}}</P>
        </div>
    @endif
    @if($hasRaid == true && $raidgroup == true)
        <div class="text-center">
            <p class="text-info">Du har blivit utvald till raidgruppen. Du kan inte längre ändra din roll.</p>
        </div>
    @elseif($hasRaid == true)
    <div class="col-md-12 text-center">
        {{Form::open(['route' => ['change.status', $raid->id]])}}
        <div class="form-group">
        {{Form::select('role', ['Tank' => 'Tank', 'Healer' => 'Healer', 'Ranged' => 'Ranged', 'Melee' => 'Melee'],'', ['class' => 'select select-primary'])}}
        {{Form::select('status', ['available' => 'Tillgänglig', 'unsure' => 'Osäker', 'no' => 'Kan ej'],'', ['class' => 'select select-primary'])}}
        </div>
        <div class="form-group col-sm-6 col-sm-offset-3">
        {{Form::text('notes', null, ['class' => 'form-control input-sm', 'placeholder' => 'Meddelande'])}}
        </div>
        <div class="form-group col-sm-12">
        {{Form::submit('Ändra Status', ['class' => 'btn btn-primary btn-sm'])}}
        </div>
        {{Form::close()}}
        </div>
       @else
    <div class="col-md-12 text-center">
        {{Form::open(['route' => ['signup', $raid->id]])}}
        <div class="form-group">
        {{Form::select('role', ['Tank' => 'Tank', 'Healer' => 'Healer', 'Ranged' => 'Ranged', 'Melee' => 'Melee'],'', ['class' => 'select select-primary'])}}
        {{Form::select('status', ['available' => 'Tillgänglig', 'unsure' => 'Osäker', 'no' => 'Kan ej'],'', ['class' => 'select select-primary'])}}
        </div>
        <div class="form-group col-sm-6 col-sm-offset-3">
        {{Form::label('notes', 'Meddelande')}}
        {{Form::text('notes', null, ['class' => 'form-control input-sm'])}}
        </div>
        <div class="form-group col-sm-12">
        {{Form::submit('Signa upp', ['class' => 'btn btn-primary btn-sm'])}}
        </div>
        {{Form::close()}}
        </div>
    @endif

    <div class="col-sm-12">
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab">
          <h6 class="panel-title">
             Raidgrupp
          </h6>
        </div>
          <div class="panel-body">
            <div class="col-xs-3">
                <p>Tank</p>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Tank' && $user->pivot->raid_status == 'selected')
                    <li  class="clearfix list-margin"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} @if(!$user->pivot->notes == '')
                      <span class="glyphicon glyphicon-warning-sign"></span>
                        @endif</p></a></li>
                    @endif
                @endforeach
                </ul>
                </div>
                <div class="col-xs-3">
                <p>Melee</p>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Melee' && $user->pivot->raid_status == 'selected')
                    <li  class="clearfix list-margin"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"><p class="{{$user->profile->klass}}">{{$user->username}}  @if(!$user->pivot->notes == '')
                    <span class="glyphicon glyphicon-warning-sign"></span>
                      @endif </p></a> </li>
                    @endif
                @endforeach
                </ul>
                </div>
                <div class="col-xs-3">
                <p>Ranged</p>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Ranged' && $user->pivot->raid_status == 'selected')
                    <li  class="clearfix list-margin"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}}@if(!$user->pivot->notes == '')
                                                                                                                                                                                                                                                                                                                                               <span class="glyphicon glyphicon-warning-sign"></span>
                                                                                                                                                                                                                                                                                                                                                 @endif </p></a> </li>
                    @endif
                @endforeach
                </ul>
                </div>
                <div class="col-xs-3">
                <p>Healer</p>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Healer' && $user->pivot->raid_status == 'selected')
                    <li  class="clearfix list-margin"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}}@if(!$user->pivot->notes == '')
                                                                                                                                                                                                                                                                                                                                               <span class="glyphicon glyphicon-warning-sign"></span>
                                                                                                                                                                                                                                                                                                                                                 @endif </p></a> </li>
                    @endif
                @endforeach
                </ul>
                </div>
          </div>






      <div class="panel-heading" role="tab">
        <h6 class="panel-title">
          Tillgängliga Spelare
          </a>
        </h6>
      </div>
        <div class="panel-body">
        <div class="col-xs-3">
        <p>Tank</p>
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
            @if($user->pivot->raid_role == 'Tank' && $user->pivot->raid_status == 'available')
            <li  class="clearfix list-margin"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} @if(!$user->pivot->notes == '')
                                                                                                                                                                                                                                                                                                                                        <span class="glyphicon glyphicon-warning-sign"></span>
                                                                                                                                                                                                                                                                                                                                          @endif </p></a> </li>
            @endif
        @endforeach
        </ul>
        </div>
        <div class="col-xs-3">
        <p>Melee</p>
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
            @if($user->pivot->raid_role == 'Melee' && $user->pivot->raid_status == 'available')
            <li class="clearfix list-margin"><img class="img-circle thumbnail-mini pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} @if(!$user->pivot->notes == '')
                                                                                                                                                                                                                                                                                                                                      <span class="glyphicon glyphicon-warning-sign"></span>
                                                                                                                                                                                                                                                                                                                                        @endif</p></a> </li>
            @endif
        @endforeach
        </ul>
        </div>
        <div class="col-xs-3">
        <p>Ranged</p>
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
            @if($user->pivot->raid_role == 'Ranged' && $user->pivot->raid_status == 'available')
            <li  class="clearfix list-margin"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"><a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} @if(!$user->pivot->notes == '')
                                                                                                                                                                                                                                                                                                                                       <span class="glyphicon glyphicon-warning-sign"></span>
                                                                                                                                                                                                                                                                                                                                         @endif</p></a> </li>
            @endif
        @endforeach
        </ul>
        </div>
        <div class="col-xs-3">
        <p>Healer</p>
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
            @if($user->pivot->raid_role == 'Healer' && $user->pivot->raid_status == 'available')
            <li  class="clearfix list-margin"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"><a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} @if(!$user->pivot->notes == '')
                                                                                                                                                                                                                                                                                                                                       <span class="glyphicon glyphicon-warning-sign"></span>
                                                                                                                                                                                                                                                                                                                                         @endif</p></a> </li>
            @endif
        @endforeach
        </ul>
        </div>
        </div>





    <div class="panel-heading" role="tab">
          <h6 class="panel-title">
            Osäkra
          </h6>
        </div>
          <div class="panel-body">
          <div class="col-sm-12">
            <ul class="list-unstyled list-inline">
            @foreach($raid->users as $user)
                @if($user->pivot->raid_status == 'unsure')
                <li  class="clearfix list-margin"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} @if(!$user->pivot->notes == '')
                                                                                                                                                                                                                                                                                                                                            <span class="glyphicon glyphicon-warning-sign"></span>
                                                                                                                                                                                                                                                                                                                                              @endif</p></a> </li>
                @endif
            @endforeach
            </ul>
          </div>
          </div>




      <div class="panel-heading" role="tab">
        <h6 class="panel-title">
            Kan ej
        </h6>
      </div>
        <div class="panel-body">
        <div class="col-sm-12">
        <ul class="list-unstyled list-inline">
        @foreach($raid->users as $user)
        @if($user->pivot->raid_status == 'no')
          <li  class="clearfix"><img class="img-circle thumbnail-mini  pull-left" data-toggle="tooltip" data-placement="top" title="{{$user->pivot->notes}}"  src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} @if(!$user->pivot->notes == '')
                                                                                                                                                                                                                                                                                                                          <span class="glyphicon glyphicon-warning-sign"></span>
                                                                                                                                                                                                                                                                                                                            @endif</p></a></li>
          @endif
        @endforeach
        </ul>
        </div>
        </div>
        </div>
    </div>
      </div>
      </div>
        <div class="col-sm-12">
         @include('laravel-comments::comments', ['commentable' => $raid, 'comments' => $raid->comments])
         </div>
    </div>

@stop

@section('javascript')
    <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop