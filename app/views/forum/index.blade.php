@extends('layouts.home')

@section('content')

<div class="row">
    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
<div class="col-md-12">
    @if(Session::has('flash_message'))
        <p class="text-info">{{Session::get('flash_message')}}</p>
     @endif
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#group_form">Lägg till Grupp</a>
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#category_form">Lägg till Kategori</a>
</div>
    @endif
</div>
<div class="row">
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table panel panel-default">
        @foreach($groups as $group)
            @if($group->title == "Officer Forum")
                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
        <tbody class="panel-heading">
        <tr>
            <th><p class="panel-title">{{$group->title}}</p></th>
            <td><P>Trådar</P></td>
            <td><p>Inlägg</p></td>
            <td class="pull-right"><a id="{{$group->id}}" href="#" class="btn btn-danger btn-xs delete_group" data-toggle="modal" data-target="#group_delete">Ta bort</a> </td>
        </tr>
        </tbody>
        <tbody class="panel-body">
            @foreach($group->categories as $category)
            <tr>
                    <td><strong><p><a href="/forum/category/{{$category->id}}" >{{$category->title}}</a><br/><small>{{$category->subtitle}}</small></p></strong></td>
                    <td>{{count($category->threads)}}</td>
                    <td>123</td>d>
            </tr>

            @endforeach
            </tbody>
            @endif
            @else
            <tbody class="panel-heading">
            <tr>
                <th><p class="panel-title">{{$group->title}}</p></th>
                <td><P>Trådar</P></td>
                <td><p>Inlägg</p></td>
                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
                <td class="pull-right"><a id="{{$group->id}}" href="#" class="btn btn-danger btn-xs delete_group" data-toggle="modal" data-target="#group_delete">Ta bort</a> </td>
                @endif
            </tr>
            </tbody>
            <tbody class="panel-body">
                @foreach($group->categories as $category)
                <tr>
                    <td><strong><p><a href="/forum/category/{{$category->id}}" >{{$category->title}}</a><br/><small>{{$category->subtitle}}</small></p></strong></td>
                    <td>{{count($category->threads)}} </td>
                    <td>{{count($category->comments)}}</td>

                </tr>
                @endforeach
                </tbody>
                @endif
            @endforeach
        </table>
    </div>
</div>
</div>

    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
        <div class="modal fade" id="group_form" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Lägg till Grupp</h4>
                    </div>
                    <div class="modal-body">
                        {{Form::open(['method' => 'post', 'route' => ['forum-store-group'], 'id' => 'target_form'])}}
                        <div class="form-group">
                        {{Form::label('title','Namn')}}
                        {{Form::text('title', null, ['class' => 'form-control'])}}
                        </div>
                        {{Form::close()}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" btn btn-danger" data-dismiss="modal">Stäng</button>
                        <button type="button" class=" btn btn-primary" data-dismiss="modal" id="form_submit">Spara</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
            <div class="modal fade" id="category_form" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Lägg till en Kategori</h4>
                        </div>
                        <div class="modal-body">
                            {{Form::open(['method' => 'post', 'route' => ['forum-store-category'], 'id' => 'target_category_form'])}}
                            <div class="form-group">
                            {{Form::label('title','Namn')}}
                            {{Form::text('title', null, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                            {{Form::label('subtitle','Beskrivning')}}
                            {{Form::text('subtitle', null, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                            {{Form::label('id', 'I vilken grupp ska kategorin placeras?')}}
                             <select class="form-control" name="id">
                                @foreach($groups as $group)
                                <option value="{{ $group->id}}">{{$group->title}}</option>
                                @endforeach
                             </select>

                            </div>
                            {{Form::close()}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" btn btn-danger" data-dismiss="modal">Stäng</button>
                            <button type="button" class=" btn btn-primary" data-dismiss="modal" id="form_category_submit">Spara</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
            <div class="modal fade" id="group_delete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Ta bort Grupp</h4>
                        </div>
                        <div class="modal-body">
                            <p>Är du säker på att du vill ta bort denna grupp?  </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" btn btn-danger" data-dismiss="modal">Stäng</button>
                            <a id="btn_delete_group"  class=" btn btn-primary">Ta bort</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
@stop