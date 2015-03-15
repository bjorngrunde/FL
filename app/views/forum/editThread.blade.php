@extends('layouts.home')
@section('css')
<link rel="stylesheet" href="/js/wysiBB/theme/default/wbbtheme.css" />
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Skapa ny tråd</h3>
    </div>
    <div class="col-sm-12">
        {{Form::model($thread,['method' => 'POST', 'route' => ['threadUpdate', $thread->id]])}}
        <div class="form-group">
        {{Form::label('title' , 'Titel')}}
        {{Form::text('title', null, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
        {{Form::label('body' , 'Innehåll')}}
        {{Form::textarea('body', null, ['class' => 'form-control forum-edit-thread'])}}
        </div>
        <div class="form-group text-center">
        {{Form::submit('Spara', ['class' => 'btn btn-primary btn-sm'])}}
        </div>
        {{Form::close()}}
    </div>
</div>

@stop

@section('javascript')
<script src="/js/jquery.js"></script>
<script src="/js/wysiBB/jquery.wysibb.min.js"></script>
<script src="/js/wysiBB/lang/sv.js"></script>
<script>
$(document).ready(function() {
        var wbbOpt = {
         buttons: "bold,italic,underline,strike,fontsize,|,img,video,link,|,bullist,numlist,|,code,quote, table",
        lang: "sv"
        }
        $(".forum-edit-thread").wysibb(wbbOpt);

         //Set BBcode text
       // $(".forum-edit-thread") //Get HTML content
        /*$(".forum-edit-thread").htmlcode(htmlcode);*/
        });
        </script>
<script>
@stop