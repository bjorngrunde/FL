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
        <a href="/admin/create/{{$raid->id}}/raidgroup" class="btn btn-danger btn-sm">Skapa Raidgrupp</a>
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
    @if($hasRaid == true)
    <div class="text-center">
        {{Form::open(['route' => ['change.status', $raid->id]])}}
        {{Form::select('role', ['Tank' => 'Tank', 'Healer' => 'Healer', 'Ranged' => 'Ranged', 'Melee' => 'Melee'],'', ['class' => 'select select-primary'])}}
        {{Form::select('status', ['available' => 'Tillgänglig', 'unsure' => 'Osäker', 'no' => 'Kan ej'],'', ['class' => 'select select-primary'])}}
        <div class="form-group">
        {{Form::submit('Ändra Status', ['class' => 'btn btn-primary'])}}
        </div>
        {{Form::close()}}
        </div>
       @else
    <div class="text-center">
        {{Form::open(['route' => ['signup', $raid->id]])}}
        {{Form::select('role', ['Tank' => 'Tank', 'Healer' => 'Healer', 'Ranged' => 'Ranged', 'Melee' => 'Melee'],'', ['class' => 'select select-primary'])}}
        {{Form::select('status', ['available' => 'Tillgänglig', 'unsure' => 'Osäker', 'no' => 'Kan ej'],'', ['class' => 'select select-primary'])}}
        <div class="form-group">
        {{Form::submit('Signa upp', ['class' => 'btn btn-primary'])}}
        </div>
        {{Form::close()}}
        </div>
    @endif

    <div class="col-sm-12">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
             <h6>Raidgrupp</h6>
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
            <div class="col-xs-3">
                <h6>Tank</h6>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Tank' && $user->pivot->raid_status == 'selected')
                    <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} </p></a> </li>
                    @endif
                @endforeach
                </ul>
                </div>
                <div class="col-xs-3">
                <h6>Melee</h6>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Melee' && $user->pivot->raid_status == 'selected')
                    <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"><p class="{{$user->profile->klass}}">{{$user->username}}  </p></a> </li>
                    @endif
                @endforeach
                </ul>
                </div>
                <div class="col-xs-3">
                <h6>Ranged</h6>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Ranged' && $user->pivot->raid_status == 'selected')
                    <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} </p></a> </li>
                    @endif
                @endforeach
                </ul>
                </div>
                <div class="col-xs-3">
                <h6>Healer</h6>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Healer' && $user->pivot->raid_status == 'selected')
                    <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} </p></a> </li>
                    @endif
                @endforeach
                </ul>
                </div>
          </div>
          </div>
        </div>



      <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
           <h6>Tillgängliga Spelare</h6>
          </a>
        </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
        <div class="col-xs-3">
        <h6>Tank</h6>
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
            @if($user->pivot->raid_role == 'Tank' && $user->pivot->raid_status == 'available')
            <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} </p></a> </li>
            @endif
        @endforeach
        </ul>
        </div>
        <div class="col-xs-3">
        <h6>Melee</h6>
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
            @if($user->pivot->raid_role == 'Melee' && $user->pivot->raid_status == 'available')
            <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}}</p></a> </li>
            @endif
        @endforeach
        </ul>
        </div>
        <div class="col-xs-3">
        <h6>Ranged</h6>
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
            @if($user->pivot->raid_role == 'Ranged' && $user->pivot->raid_status == 'available')
            <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"><a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} </p></a> </li>
            @endif
        @endforeach
        </ul>
        </div>
        <div class="col-xs-3">
        <h6>Healer</h6>
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
            @if($user->pivot->raid_role == 'Healer' && $user->pivot->raid_status == 'available')
            <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"><a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} </p></a> </li>
            @endif
        @endforeach
        </ul>
        </div>
        </div>
        </div>
      </div>


    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
             <h6>Osäkra</h6>
            </a>
          </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
          <div class="panel-body">
          <div class="col-sm-12">
            <ul class="list-unstyled">
            @foreach($raid->users as $user)
                @if($user->pivot->raid_status == 'unsure')
                <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} </p></a> </li>
                @endif
            @endforeach
            </ul>
          </div>
          </div>
        </div>
      </div>

      <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingFour">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
           <h6>Kan ej</h6>
          </a>
        </h4>
      </div>
      <div id="collapseFour" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingFour">
        <div class="panel-body">
        <div class="col-sm-12">
        <ul class="list-unstyled">
        @foreach($raid->users as $user)
        @if($user->pivot->raid_status == 'no')
          <li><img class="img-circle thumbnail-mini  pull-left" src="{{$user->profile->thumbnail}}"> <a href="/profile/{{$user->username}}"> <p class="{{$user->profile->klass}}">{{$user->username}} </p></a></li>
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