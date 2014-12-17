@extends('layouts.home')

@section('content')

<div class="row">

<div class="col-md-12">
    @if(Session::has('flash_message'))
        <p class="text-info">{{Session::get('flash_message')}}</p>
     @endif
</div>
</div>
<div class="row">
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table panel panel-default">
        <tbody class="panel-heading">
        <tr>
            <th><h6>{{$category->title}}</h6></th>
            <th><P>Svar</P></th>

            @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
            <th class="pull-right"><a id="{{$category->id}}" href="#" class="btn btn-danger btn-xs delete_group" data-toggle="modal" data-target="#group_delete">Ta bort</a> </th>
            @endif

        </tr>
        </tbody>
        <tbody class="panel-body">
        @if(count($category->threads) > 0)
            @foreach($category->threads as $thread)
                    <tr>
                    <td><strong><p><a href="/forum/thread/{{$thread->id}}">{{$thread->title}}</a></p></strong></td>
                    <td>{{count($thread->comments)}}</td>
                    </tr>
            @endforeach
        @else
        <tr>
        <td>
        <p>Det finns inga trådar än, var den första att skapa en!</p>
        </td>
        </tr>
            @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
@stop

