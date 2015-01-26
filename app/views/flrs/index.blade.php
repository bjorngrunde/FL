@extends('layouts.home')

@section('content')
<div class="row">

    <div class="col-md-12">
    <div class="col-md-12 dark-sh-well-no-radius">
        {{$cal->generate()}}
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="table-responsive">
            <table class="table">
                <tr>
                <th>Raid</th>
                <th>Tier</th>
                <th>Datum</th>
                <th>Start</th>
                <th>Slut</th>
                <th>Signad</th>
                </tr>
                <tbody>
                    @foreach($raids as $raid)
                    <tr class="dark-sh-well-no-radius">
                        <td><p><a href="/flrs/show/{{$raid->id}}" >{{$raid->title}}</a></p></td>
                        <td><p>{{$raid->mode}}</p></td>
                        <td><p>{{$raid->time}}</p></td>
                        <td><p>{{$raid->startTime}}</p></td>
                        <td><p>{{$raid->endTime}}</p></td>
                        <td>
                            @foreach($raid->users as $user)
                                @if($user->username == Auth::user()->username)
                                    @if($user->pivot->raid_status == 'available')
                                    <p class="text-success">Tillgänglig</p>
                                    @elseif($user->pivot->raid_status == 'selected')
                                    <p class="text-success">Utvald</p>
                                    @elseif($user->pivot->raid_status == 'unsure')
                                    <p class="text-warning">Osäker</p>
                                    @elseif($user->pivot->raid_status == 'no')
                                    <p class="text-warning">Kan ej</p>
                                    @endif
                                @endif
                            @endforeach
                            @if(!Auth::user()->hasRaid($raid->id))
                                <p class="text-danger">Ej signad</p>
                            @endif
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    </div>
</div>

@stop