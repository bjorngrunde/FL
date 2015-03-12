@extends('layouts/admin')

@section('content')
        <div class="row">
        <div class="col-md-12 text-center">
        <h1>Admin Dashboard</h1>
        </div>
            <div class="col-sm-12 text-center">
            <div class="col-sm-3 well well-sm">
                <a href="/admin/applications">
                <div class="text-default">
                <i class="glyphicon glyphicon-comment glyphicon-admin-dashboard"></i>
                <h3>Ansökningar</h3>
                </div>
                </a>
            </div>
            <div class="col-sm-3 well well-sm">
                <a href="/admin/users">
                <div class="text-default">
                <i class="glyphicon glyphicon-user glyphicon-admin-dashboard"></i>
                <h3 class="">Användare</h3>
                </div>
                </a>
            </div>
            <div class="col-sm-3 well well-sm">
                <a href="/admin/flrs/index">
                <div class="text-default">
                <i class="glyphicon glyphicon-calendar glyphicon-admin-dashboard"></i>
                <h3 class="">Raids</h3>
                </div>
                </a>
            </div>
            <div class="col-sm-3 well well-sm">
                <a href="/admin/posts/index">
                <div class="text-default">
                <i class="glyphicon glyphicon-pencil glyphicon-admin-dashboard"></i>
                <h3 class="">Nyheter</h3>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 text-center">
            <h2>Flöde</h2>
            @foreach($notifications as $notification)
                @if(strpos($notification->type, 'Updated'))
                <div class="well well-sm">
                <h4><i class="glyphicon glyphicon-edit text-info"></i> {{$notification->subject}}</h4>
                <p>{{$notification->body}}</p>
                </div>
                @elseif(strpos($notification->type, 'Posted'))
                <div class="well well-sm">
                <h4><i class="glyphicon glyphicon-ok-sign text-success"></i> {{$notification->subject}}</h4>
                <p>{{$notification->body}}</p>
                </div>
                @else
                <div class="well well-sm">
                <h4><i class="glyphicon glyphicon-trash text-danger"></i> {{$notification->subject}}</h4>
                <p>{{$notification->body}}</p>
                </div>
                @endif
            @endforeach
        </div>
        <div class="col-sm-6 text-center">
            <h2>Snabblänkar</h2>
            <ul class="list-unstyled">
                <li class="well well-sm"><a href="/admin/users/create"><h4>Skapa en användare </h4></a></li>
                <li class="well well-sm"><a href="/admin/flrs/create"><h4>Skapa en raid </h4></a></li>
                <li class="well well-sm"><a href="/admin/posts/create"><h4>Skapa en nyhet </h4></a></li>
            </ul>
        </div>
    </div>
@stop