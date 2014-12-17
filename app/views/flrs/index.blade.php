@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-md-12">
        {{$cal->generate()}}
    </div>
</div>

@stop