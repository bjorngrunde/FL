@extends('layouts.home')

@section('content')

<div class="row">
    <div class="class-sm-12">
    {{Form::open(['method' => 'post', 'route' => 'store.message'])}}
        </div>
    @endforeach
    </div>
</div>


@stop