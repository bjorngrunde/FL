@extends('layouts.admin')

@section('content')
    <div class="row">
    <div clas="col-md-12">
        <h4 class="text-center">Ansökan inskickad av: {{$application->name}} {{$application->lastName}}</h4>
        <hr class="divider-invisible"/>
    </div>
    </div>
    <div class="row">
        <div class="col-md-6">
           <p><strong>Namn:</strong> {{$application->name}} {{$application->lastName}}</p>
           <p><strong>Email:</strong> {{$application->email}}</p>
           <p><strong>Armory:</strong><a href="{{$application->armory}}">{{$application->armory}}</a></p>
            <p><strong>Status:</strong>
            @if (!empty($application->status))
             @if($application->status->app_status == 'default')
                  Väntar på beslut
             @elseif($application->status->app_status =='denied')
                  Nekad
              @elseif($application->status->app_status == 'approved')
                 Accepterad
              @endif
          @else
            Ingens status hittades
          @endif
          </p>
        </div>
         <div class="col-md-6">
           <p><strong>Huvudkaraktär:</strong> {{$application->username}}</p>
           <p><strong>Spec:</strong>  {{$application->talents}}</p>
           <p><strong>Server:</strong> {{$application->server }}</p>
           <p><strong>Klass:</strong> @if($application->klass == 'death-knight')Death Knight @else {{$application->klass}} @endif </p>
        </div>
        <div class="col-md-12">
         <hr class="divider-invisible"/>
        </div>
        <div class="col-md-12">
           <strong><p>Vad är din speltid på din karaktär och/eller betydelsefulla alts:</p></strong>
            <p>{{ $application->played }}</p>
        </div>
        <div class="col-md-12">
            <strong><p>Varför valde du att spela just den class och spec du spelar nu. Skulle du kunna tänka dig spela en annan class eller spec om vi känner att det är bättre för guildet?</p></strong>
            <p>{{ $application->playClass }}</p>
        </div>
        <div class="col-md-12">
        <strong><p>Berätta lite om dig själv?</p></strong>           
        <p>{{ $application->bio }}</p>
        </div>
        <div class="col-md-12">
        <strong><p>Berätta om din raiderfarenhet. Har du ingen så berätta om andra gamingerfarenheter, må det vara WoW eller andra spel.</p></strong> 
        <p>{{ $application->raidExperience }}</p>
        </div>
        <div class="col-md-12">
            <strong><p>Berätta vad du söker i ett guild och varför du sökte just till Family Legion?</p></strong>
            <p>{{ $application->reasonToApplyFl }}</p>
        </div>
        <div class="col-md-12">
            <strong><p>Om du var medlem i andra guilds, berätta for oss varför du lämnade.</p></strong>
            <p>{{ $application->oldGuild }}</p>
        </div>
        <div class="col-md-12">
            <strong><p>Vad tycker du om progressraiding, raida för achivements och raida gammalt content?</p></strong>
            <p>{{ $application->progressRaid }}</p>
        </div>
        <div class="col-md-12">
           <strong> <p>Vi använder ett rotationsystem baserat på närvaro, vad tycker du om det?</p></strong>
            <p>{{ $application->attendance }}</p>
        </div>
        <div class="col-md-12">
           <strong> <p>Mitt Raid UI</p></strong>
            <img src="{{$application->screenshot}}" class="img-responsive" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('laravel-comments::comments', ['commentable' => $application, 'comments' => $application->comments]);
        </div>
    </div>
@stop