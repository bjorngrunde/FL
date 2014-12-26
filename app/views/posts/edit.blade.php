@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h5 class="text-center">Skapa ett inlägg</h5>
            @if(Session::has('flash_message'))
                <p class="text-success">{{Session::get('flash_message')}}</p>
            @endif
        </div>
        <div class="col-md-12">
            {{Form::model($post,['method' => 'PATCH','route' =>[ 'posts.update', $post->id], 'files' => true])}}
            <div class="form-group">
            {{Form::label('title', 'Titel')}}
            {{Form::text('title', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
            {{Form::label('body', 'Innehåll')}}
            {{Form::textarea('body', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
            {{Form::label('img', 'Ladda upp en bild')}}
            {{Form::file('img')}}
            </div>
            <div class="form-group text-center">
            {{Form::submit('Spara', ['class' => 'btn btn-primary btn-lg'])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
@stop

@section('javascript')
<script src="/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({selector:'textarea'
                  });
</script>
@stop