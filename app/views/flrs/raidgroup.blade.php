@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Skapa Raidgrupp för {{$raid->title}} med datum {{$raid->time}}</h3>
       {{Form::open(['method' => 'POST', 'route' => ['save.raidgroup', $raid->id]])}}
       <div class="col-sm-12">

            <div class="col-sm-3">
                <h6>Tank</h6>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Tank' && $user->pivot->raid_status == 'available')
                    <li>

                         {{Form::checkbox($user->username, 'selected', true, ['class' => 'checkbox-inline'])}}
                         {{Form::label($user->username, $user->username, ['class' => $user->profile->klass])}}


                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-3">
                <h6>Melee</h6>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Melee' && $user->pivot->raid_status == 'available')
                    <li>

                         {{Form::checkbox($user->username, 'selected', true, ['class' => 'checkbox-inline'])}}
                         {{Form::label($user->username, $user->username, ['class' => $user->profile->klass])}}

                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-3">
                <h6>Ranged</h6>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Ranged' && $user->pivot->raid_status == 'available')
                    <li>

                         {{Form::checkbox($user->username, 'selected', true, ['class' => 'checkbox-inline'])}}
                         {{Form::label($user->username, $user->username, ['class' => $user->profile->klass])}}

                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-3">
                <h6>Healer</h6>
                <ul class="list-unstyled">
                @foreach($raid->users as $user)
                    @if($user->pivot->raid_role == 'Healer' && $user->pivot->raid_status == 'available')
                    <li>

                         {{Form::checkbox($user->username, 'selected', true, ['class' => 'checkbox-inline'])}}
                         {{Form::label($user->username, $user->username, ['class' => $user->profile->klass])}}

                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="text-center col-md-12">
                {{Form::submit('Skapa Raidgrupp', ['class' => 'btn btn-primary btn-sm'])}}
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>
@stop