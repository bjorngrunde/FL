@extends('layouts.admin')

@section('content')
    <div class="row">
    <div class="col-md-12 text-center">
    <h3>Visar ansökan för: {{$application->name. ' ' .$application->lastName}}</h3>
    </div>
     <div class="col-md-6">
       <ol class="breadcrumb">
        <li><a href="/admin">Admin Dashboard</a></li>
        <li><a href="/admin/applications/"> Ansökningar</a></li>
        <li class="active">Ansökan - {{$application->name . ' '. $application->lastName}}</li>
       </ol>
       </div>
       <div class="col-md-6">
        <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
       </div>
    </div>
    <div class="row">
    <div clas="col-md-12">
    <ul class="list-inline list-unstyled">
        <li>
        <a href="/admin/applications/{{$application->id}}/edit" class="btn btn-warning btn-sm">Redigera</a>
        </li>
        <li>
        {{Form::open(['method' => 'DELETE', 'route' => ['application.destroy', $application->id]])}}
        {{Form::submit('Ta bort', ['class' => 'btn btn-danger  btn-sm'])}}
        {{Form::close()}}
        </li>
    </ul>
    </div>
        <div class="col-md-6 well well-sm">
           <p><strong>Namn:</strong> {{$application->name}} {{$application->lastName}}</p>
           <p><strong>Email:</strong> {{$application->email}}</p>
           <p><strong>Armory:</strong><a href="{{$application->armory}}">{{$application->armory}}</a></p>
            <p><strong>Status:</strong>
            @if (!empty($application->status))
             @if($application->status->app_status == 'default')
                 <span class="text-info"> <i class="glyphicon glyphicon-question-sign"></i> Väntar på beslut</span>
             @elseif($application->status->app_status =='denied')
                 <span class="text-danger"><i class="glyphicon glyphicon-trash"></i>  Nekad </span>
              @elseif($application->status->app_status == 'approved')
                <span class="text-success"> <i class="glyphicon glyphicon-thumbs-up"></i>  Accepterad </span>
              @endif
          @else
            Ingens status hittades
          @endif
          </p>
        </div>
         <div class="col-md-6 well well-sm">
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
            <p class="well well-sm">{{ $application->played }}</p>
        </div>
        <div class="col-md-12">
            <strong><p>Varför valde du att spela just den class och spec du spelar nu. Skulle du kunna tänka dig spela en annan class eller spec om vi känner att det är bättre för guildet?</p></strong>
            <p class="well well-sm">{{ $application->playClass }}</p>
        </div>
        <div class="col-md-12">
        <strong><p>Berätta lite om dig själv?</p></strong>           
        <p class="well well-sm">{{ $application->bio }}</p>
        </div>
        <div class="col-md-12">
        <strong><p>Berätta om din raiderfarenhet. Har du ingen så berätta om andra gamingerfarenheter, må det vara WoW eller andra spel.</p></strong> 
        <p class="well well-sm">{{ $application->raidExperience }}</p>
        </div>
        <div class="col-md-12">
            <strong><p>Berätta vad du söker i ett guild och varför du sökte just till Family Legion?</p></strong>
            <p class="well well-sm">{{ $application->reasonToApplyFl }}</p>
        </div>
        <div class="col-md-12">
            <strong><p>Om du var medlem i andra guilds, berätta for oss varför du lämnade.</p></strong>
            <p class="well well-sm">{{ $application->oldGuild }}</p>
        </div>
        <div class="col-md-12">
            <strong><p>Vad tycker du om progressraiding, raida för achivements och raida gammalt content?</p></strong>
            <p class="well well-sm">{{ $application->progressRaid }}</p>
        </div>
        <div class="col-md-12">
           <strong> <p>Vi använder ett rotationsystem baserat på närvaro, vad tycker du om det?</p></strong>
            <p class="well well-sm">{{ $application->attendance }}</p>
        </div>
        <div class="col-md-12">
           <strong> <p>Mitt Raid UI</p></strong>
            <img src="{{$application->screenshot}}" class="img-responsive well well-sm" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('laravel-comments::comments', ['commentable' => $application, 'comments' => $application->comments]);
        </div>
    </div>
@stop