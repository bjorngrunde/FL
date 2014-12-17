@extends('layouts/admin')

@section('content')
<div class="row">
    <div class="col-sm-12 text-center">
        <h2>Admin Dashboard</h2>
        @if(Session::has('flash_message'))
            <p class="text-success">{{ Session::get('flash_message') }}</p>
        @endif
    </div>
</div>
@stop