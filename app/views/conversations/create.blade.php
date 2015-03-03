@extends('layouts.home')

@section('css')
   <link href="/js/tags/tagmanager.css" rel="stylesheet" />
@stop

@section('content')

<div class="row">
    <div class="col-sm-12 text-center">
        <h4>Skicka meddelande</h4>
        <p>För att lägga till personer i en konversation, skriv deras namn tills de dyker upp i menyn. Markera personen och tryck TAB. Upprepa om du vill lägga till flera personer.</p>
        @if(Session::has('flash_message'))
        <h5 class="text-center text-primary">{{Session::get('flash_message')}}</h5>
        @else
        <p>Skicka ett meddelande till en eller flera användare.</p>
        @endif
    </div>
    <div class="col-sm-6 col-sm-offset-3">
    {{Form::open(['method' => 'POST', 'route' => 'conversation.store'])}}
    <div class="form-group">
    {{Form::label('recipient', 'Mottagare')}}
    {{Form::text('recipient', null, ['class' => 'form-control tm-input tm-input-info tm-input-small', 'id' => 'sender', 'placeholder' => 'Välj mottagare'])}}
    </div>
    <div class="form-group">
    {{Form::label('subject', 'Ämne')}}
    {{Form::text('subject', null, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
    {{Form::label('message', 'Meddelande')}}
    {{Form::textarea('message', null, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
    {{Form::submit('Skicka', ['class' => 'btn btn-primary btn-sm'])}}
    </div>
    {{Form::close()}}
    </div>
</div>


@stop

@section('javascript')
<script src="/js/tags/tagmanager.js"></script>
<script>
    $('#sender').autocomplete({
        source: '/query',
        minLength: 2
    });
   </script>
   <script>
       jQuery(".tm-input").tagsManager();
   </script>
@stop