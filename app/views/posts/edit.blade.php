@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Rediger en nyhet</h3>
        </div>
         <div class="col-md-6">
               <ol class="breadcrumb">
                <li><a href="/admin">Admin Dashboard</a></li>
                <li><a href="/admin/posts/index">Nyheter</a></li>
                <li class="active">Redigera Nyhet</li>
               </ol>
               </div>
               <div class="col-md-6">
                <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
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