@extends('layouts.admin')

@section('content')
<div class="row">
<div class="col-md-12">
        <h3 class="text-center">Redigera Instans</h3>
    </div>
     <div class="col-md-6">
           <ol class="breadcrumb">
            <li><a href="/admin">Admin Dashboard</a></li>
            <li><a href="/admin/flrs/instance">Instanser</a></li>
            <li class="active">Redigera Instans</li>
           </ol>
           </div>
           <div class="col-md-6">
            <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
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
                    {{Form::submit('Spara', ['class' => 'btn btn-primary btn-sm'])}}
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@stop
