@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 text-center">
        <h4>Redigera Ansökan</h4>
        @if(Session::has('flash_message'))
        <p class="text-success">{{ Session::get('flash_message') }}</p>
        @else
        <p>Ändrar du beslutet till "Accepterad" så kan du skapa en användare från ansökan.</p>
        @endif
    </div>
    </div>

    <div class="row">
        <div class="col-md-12">
          @if($application->status->app_status == 'approved')
          {{ Form::model($application, ['method'=>'POST', 'route' => ['registration.store'],'files' => true]) }}
          <div class="col-md-12 text-center">
          </div>
            <div class="col-md-6">
            <div class="form-group">
                <p class="text-center">Ändra status på ansökan</p>
                {{ Form::select('app_status', ['default' => 'Väntar på beslut', 'denied' => 'Nekad', 'approved' => 'Accepterad'], $application->status->app_status, ['class' => 'form-control']) }}
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <p class="text-center">Sätt en rank</p>
                {{Form::select('rank', ['Trial' => 'Trial', 'Social' => 'Social', 'Raider' => 'Raider', 'Officer' => 'Officer', 'Guild Master' => 'Guild Master'], 'Trial', ['class' => 'form-control'])}}
                </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', 'Förnamn') }}
                {{ Form::text('name', null,  ['class' => 'form-control']) }}
                {{ $errors->first('name', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                {{ Form::label('lastName', 'Efternamn') }}
                {{ Form::text('lastName', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('lastName', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('username', 'Din huvudkaraktär') }}
                {{ Form::text('username', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('username', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('email', 'Din Email') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('email', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('klass', 'Vilken klass?', ['class' => 'text-white']) }}
                {{ Form::select('klass',['death-knight' => 'Death Knight', 'druid' => 'Druid','hunter' => 'Hunter', 'mage'=>'Mage', 'monk' => 'Monk','priest' =>
                 'Priest','paladin' => 'Paladin', 'rogue' => 'Rogue', 'shaman' => 'Shaman','warlock' => 'Warlock', 'warrior' => 'Warrior' ],null,
                   ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('klass', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
              <div class="col-md-6">
                     <div class="form-group">
                     {{ Form::label('role', 'Sätt en behörighet') }}
                     {{ Form::select('role',['Utvecklare' => 'Utvecklare', 'Admin' => 'Admin','Medlem' => 'Medlem', 'Inaktiv'=>'Inaktiv', 'Bannad' => 'Bannad'],'',
                        ['class' => 'form-control', 'required' => 'required']) }}
                     {{ $errors->first('klass', '<p class="text-warning">:message </p>') }}
                     </div>
                     </div>

            <div class="col-md-12">
            <div class="form-group text-center">
            {{ Form::submit('Skapa användare', ['class' => 'btn btn-primary btn-lg']) }}
            </div>
            </div>
           @else
           {{ Form::model($application, ['method'=>'PATCH', 'route' => ['application.update', $application->id ],'files' => true]) }}

            <div class="col-md-12">
            <div class="form-group">
                <h4 class="text-center">Ändra status på ansökan</h4>
                {{ Form::select('app_status', ['default' => 'Väntar på beslut', 'denied' => 'Nekad', 'approved' => 'Accepterad'], $application->status->app_status, ['class' => 'form-control']) }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', 'Förnamn') }}
                {{ Form::text('name', null,  ['class' => 'form-control']) }}
                {{ $errors->first('name', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                {{ Form::label('lastName', 'Efternamn') }}
                {{ Form::text('lastName', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('lastName', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('username', 'Din huvudkaraktär') }}
                {{ Form::text('username', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('username', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                {{ Form::label('server', 'Karaktärens server') }}
                {{ Form::text('server', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('server', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('email', 'Din Email') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('email', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('armory', 'Länk till din Armory Profil') }}
                {{ Form::text('armory',null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('armory', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('talents', 'Vilken spec kör du?') }}
                {{ Form::text('talents', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('talents', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('klass', 'Vilken klass?', ['class' => 'text-white']) }}
                {{ Form::select('klass',['death-knight' => 'Death Knight', 'druid' => 'Druid','hunter' => 'Hunter', 'mage'=>'Mage', 'monk' => 'Monk','priest' =>
                 'Priest','paladin' => 'Paladin', 'rogue' => 'Rogue', 'shaman' => 'Shaman','warlock' => 'Warlock', 'warrior' => 'Warrior' ], null,
                   ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('klass', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('played', 'Vad är din speltid på din huvudkaraktär och/eller betydelsefulla alts. (Ange gärna speltid på tidigare mains med. Ange även namn och server.)' )}}
                {{ Form::textarea('played', null,  ['class' => 'form-control']) }}
                {{ $errors->first('played', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('playClass', 'Varför valde du att spela just den class och spec du spelar nu. Skulle du kunna tänka dig spela en annan class eller spec om vi känner att det är bättre för guildet? ') }}
                {{ Form::textarea('playClass', null,  ['class' => 'form-control']) }}
                {{ $errors->first('playClass', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('bio', 'Berätta lite om dig själv') }}
                {{ Form::textarea('bio', null,  ['class' => 'form-control']) }}
                {{ $errors->first('bio', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('raidExperience', 'Berätta om din raiderfarenhet. Har du ingen så berätta om andra gamingerfarenheter, må det vara WoW eller andra spel.') }}
                {{ Form::textarea('raidExperience', null,  ['class' => 'form-control']) }}
                {{ $errors->first('raidExperience', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('reasonToApplyFl', 'Berätta vad du söker i ett guild och varför du sökte just till Family Legion') }}
                {{ Form::textarea('reasonToApplyFl', null,  ['class' => 'form-control']) }}
                {{ $errors->first('reasonToApplyFl', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('oldGuild', 'Om du var medlem i andra Guilds, berätta för oss varför du lämnade?') }}
                {{ Form::textarea('oldGuild', null,  ['class' => 'form-control']) }}
                {{ $errors->first('oldGuild', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('progressRaid', 'Vad tycker du om progressraiding, raida för achivements och raida gammalt content?') }}
                {{ Form::textarea('progressRaid', null,  ['class' => 'form-control']) }}
                {{ $errors->first('progressRaid', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('attendance', 'Vi använder ett rotationsystem baserat på närvaro, vad tycker du om det??') }}
                {{ Form::textarea('attendance', null,  ['class' => 'form-control']) }}
                {{ $errors->first('attendance', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('screenshot', 'Ladda gärna upp en bild  på ditt raid UI') }}
                {{ Form::file('screenshot') }}
                {{ $errors->first('screenshot', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::submit('Spara', ['class' => 'btn btn-primary btn-lg']) }}
            @endif
            </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
@stop