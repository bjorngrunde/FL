@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="col-md-12 dark-sh-well">
        {{$cal->generate()}}
    </div>
    </div>
</div>

@stop