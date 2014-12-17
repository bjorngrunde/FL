@extends('layouts/home')

@section('content')
<div class="row">
<div class="col-sm-12 col-md-12">
    <div class="col-md-7">
        <img src="{{$user->profile->avatar}}" class="profile-img-avatar img-responsive" />
    </div>
    <ul class="col-md-5 list-unstyled list-inline">
    <li class="col-sm-12">
    <div class="dark-sh-well-no-radius">
    <h4 class="{{$user->profile->klass}} text-center">{{$user->username}}</h4>
    </div>
    </li>
    <li class="col-sm-6">
    <div class=" text-center dark-sh-well-no-radius">
        <small>Närvaro:</small>
        <h6>83%</h6>
    </div>
    </li>
    <li class="col-sm-6">
    <div class=" text-center dark-sh-well-no-radius">
        <small>Rank:</small>
        <h6>{{$user->profile->rank}}</h6>
      </div></li>
    <li class="col-md-12">
    <div class="text-center dark-sh-well-no-radius">
         <small>Raidgrupp:</small>
         <h6>Mythic</h6>
     </div>
     </li>
    </ul>
</div>
</div>
<div class="row">
<div class="col-sm-12">
     <hr class="divider-invisible" />
     <div class="col-xs-12 col-sm-6 col-md-4 text-center">
        <h4>Aktiviter</h4>
        <ul class="list-unstyled">
          @foreach($newsFeed as $feed)
            <li class="dark-sh-well-no-radius"><small>{{ $feed }}</small></li>
          @endforeach
        </ul>
     </div>
     <div class="col-md-4 hidden-sm hidden-xs">
        @if($user->profile->klass == 'warrior')
            <img src="/img/login/Warr.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'hunter')
            <img src="/img/login/Huntard.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'shaman')
            <img src="/img/login/Shammy.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'rogue')
            <img src="/img/login/Rogue.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'priest')
            <img src="/img/login/Priest.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'paladin')
            <img src="/img/login/Pally.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'monk')
            <img src="/img/login/monk.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'mage')
            <img src="/img/login/Mage.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'warlock')
            <img src="/img/login/Lock.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'druid')
            <img src="/img/login/Drood.png" class="img-responsive center-block" />
        @elseif($user->profile->klass == 'death-knight')
            <img src="/img/login/deathknight.png" class="img-responsive center-block" />
        @endif

        <ul class="list-unstyled list-inline">
            @foreach($gearSlots as $item)
            <li>{{$item}}</li>
            @endforeach
        </ul>
     </div>
      <div class="col-xs-12 col-sm-6 col-md-4 text-center">
         <h4>Forum</h4>
         <ul class="list-unstyled">
            <li class="dark-sh-well-no-radius">
                <p><small>Har kommenterat inlägget: <span class="text-warning">Raidgrupp 6.0</span> </small></p>
            </li>
            <li class="dark-sh-well-no-radius">
                <p><small>Har kommenterat evenemanget: <span class="text-warning">Siege of Orgrimmar, den 1 Nov, 2014</span> </small></p>
            </li>
             <li class="dark-sh-well-no-radius">
                <p><small>Har kommenterat inlägget: <span class="text-warning">IRL Pics!</span> </small></p>
            </li>
            <li class="dark-sh-well-no-radius">
                <p><small>Har skapat tråden: <span class="text-warning">Challenge Modes: WoD?</span> </small></p>
            </li>
            <li class="dark-sh-well-no-radius">
                <p><small>Har signat upp till: <span class="text-warning">Siege of Orgrimmar, den 1 Nov , 2014</span> </small></p>
            </li>
            <li class="dark-sh-well-no-radius">
                <p><small>Har signat upp till: <span class="text-warning">Siege of Orgrimmar, den 23 Okt , 2014</span> </small></p>
            </li>
         </ul>
      </div>
    </div>
</div>
@stop