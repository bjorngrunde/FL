    @extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <img src="/img/login/logo.png" class="img-responsive center-block" />
    </div>
</div>

@if(Session::has('Success'))

    <h4 class="flash-message text-white text-center">{{ Session::get('Success') }}</h4>

@else
    <div class="row login-form">
    <div class="col-md-12 text-white text-center">
            <h4>Kul att du visar intresse för oss, fyll i formuläret så hör vi av oss så snart vi kan.</h4>
        </div>
        <div class="col-md-12">
            {{ Form::open(['route' => 'application.store', 'files' => true]) }}

            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', 'Förnamn', ['class' => 'text-white']) }}
                {{ Form::text('name', null,  ['class' => 'form-control login-field', 'required' => 'required']) }}
                {{ $errors->first('name', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                {{ Form::label('lastName', 'Efternamn', ['class' => 'text-white']) }}
                {{ Form::text('lastName', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('lastName', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('username', 'Din huvudkaraktär', ['class' => 'text-white']) }}
                {{ Form::text('username', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('username', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                {{ Form::label('server', 'Karaktärens server', ['class' => 'text-white']) }}
                {{ Form::text('server', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('server', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('talents', 'Vilken spec kör du?', ['class' => 'text-white']) }}
                {{ Form::text('talents', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('talents', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('klass', 'Vilken klass?', ['class' => 'text-white']) }}
                {{ Form::select('klass',['death-knight' => 'Death Knight', 'druid' => 'Druid','hunter' => 'Hunter', 'mage'=>'Mage', 'monk' => 'Monk','priest' =>
                 'Priest','paladin' => 'Paladin', 'rogue' => 'Rogue', 'shaman' => 'Shaman','warlock' => 'Warlock', 'warrior' => 'Warrior' ],'death-knight',
                   ['class' => 'form-control', 'required' => 'required', 'data-toogle' => 'dropdown-select', 'data-style' => 'info']) }}
                {{ $errors->first('klass', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('email', 'Din Email', ['class' => 'text-white']) }}
                {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('email', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('armory', 'Länk till din Armory Profil', ['class' => 'text-white']) }}
                {{ Form::text('armory', null,  ['class' => 'form-control', 'required' => 'required']) }}
                {{ $errors->first('armory', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('played', 'Vad är din speltid på din huvudkaraktär och/eller betydelsefulla alts. (Ange gärna speltid på tidigare mains med. Ange även namn och server.)', ['class' => 'text-white'] )}}
                {{ Form::textarea('played', null,  ['class' => 'form-control']) }}
                {{ $errors->first('played', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('playClass', 'Varför valde du att spela just den class och spec du spelar nu. Skulle du kunna tänka dig spela en annan class eller spec om vi känner att det är bättre för guildet?', ['class' => 'text-white']) }}
                {{ Form::textarea('playClass', null,  ['class' => 'form-control']) }}
                {{ $errors->first('playClass', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('bio', 'Berätta lite om dig själv', ['class' => 'text-white']) }}
                {{ Form::textarea('bio', null,  ['class' => 'form-control']) }}
                {{ $errors->first('bio', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('raidExperience', 'Berätta om din raiderfarenhet. Har du ingen så berätta om andra gamingerfarenheter, må det vara WoW eller andra spel.', ['class' => 'text-white']) }}
                {{ Form::textarea('raidExperience', null,  ['class' => 'form-control']) }}
                {{ $errors->first('raidExperience', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('reasonToApplyFl', 'Berätta vad du söker i ett guild och varför du sökte just till Family Legion', ['class' => 'text-white']) }}
                {{ Form::textarea('reasonToApplyFl', null,  ['class' => 'form-control']) }}
                {{ $errors->first('reasonToApplyFl', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('oldGuild', 'Om du var medlem i andra Guilds, berätta för oss varför du lämnade?', ['class' => 'text-white']) }}
                {{ Form::textarea('oldGuild', null,  ['class' => 'form-control']) }}
                {{ $errors->first('oldGuild', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('progressRaid', 'Vad tycker du om progressraiding, raida för achivements och raida gammalt content?', ['class' => 'text-white']) }}
                {{ Form::textarea('progressRaid', null,  ['class' => 'form-control']) }}
                {{ $errors->first('progressRaid', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('attendance', 'Vi använder ett rotationsystem baserat på närvaro, vad tycker du om det??', ['class' => 'text-white']) }}
                {{ Form::textarea('attendance', null,  ['class' => 'form-control']) }}
                {{ $errors->first('attendance', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('screenshot', 'Ladda gärna upp en bild  på ditt raid UI', ['class' => 'text-white']) }}
                {{ Form::file('screenshot') }}
                {{ $errors->first('screenshot', '<p class="text-warning">:message </p>') }}
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                {{ Form::submit('Skicka in ansökan', ['class' => 'btn btn-primary btn-lg']) }}
            </div>
            </div>

            {{Form::close()}}
        </div>
    </div>

@endif
@stop