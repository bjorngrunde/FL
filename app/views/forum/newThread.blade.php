@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h6 class="text-center">Skapa ny tråd</h6>
    </div>
    <div class="col-sm-12">
        {{Form::open(['method' => 'POST', 'route' => ['newThread.store', $category->id]])}}
        <div class="form-group">
        {{Form::label('title' , 'Titel')}}
        {{Form::text('title', null, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
        {{Form::label('bory' , 'Innehåll')}}
        {{Form::textarea('body', null, ['class' => 'form-control'])}}
        </div>
        <div class="form-group text-center">
        {{Form::submit('Spara', ['class' => 'btn btn-primary btn-sm'])}}
        </div>
        {{Form::close()}}
    </div>
</div>

@stop

@section('javascript')
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
    tinymce.init({selector:'textarea'});
</script>
@stop