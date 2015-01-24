@extends('layouts.gallery')
@section('gallerySection')

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>{{ Lang::get('gallery.edit') . ' ' . Lang::choice("gallery.$type", 1) }}</b>
        </div>
        <div class="panel-body">

    {{ $form }}

    @if ($errors->any())
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
    @endif
        </div>
    </div>
</div>

@stop


