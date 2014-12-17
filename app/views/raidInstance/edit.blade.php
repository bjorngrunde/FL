@extends('layouts.admin')

@section('content')
<div class="well well-lg">
<div class="row">
<div class="col-md-12 text-center">
    <h4>Redigera instansen: {{$instance->title}}</h4>
    @if(Session::has('flash_message'))
        <p class="text-success">{{Session::get('flash_message')}}</p>
    @endif
</div>
</div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                {{Form::model($instance,['method' => 'PATCH','route' =>['raids.update', $instance->id], 'files' => true])}}
                <div class="form-group">
                {{Form::label('title', 'Ange namn på Raid')}}
                {{Form::text('title', null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                {{Form::label('backgroundImg', 'Ladda upp en ny bakgrundsbild till raiden. Bäst upplösning är 1920 * 1080.')}}
                {{Form::file('backgroundImg')}}
                </div>
                <div class="form-group text-center">
                    {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop
