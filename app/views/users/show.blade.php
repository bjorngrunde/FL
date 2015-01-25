@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Användare : {{$user->profile->name. ' ' . $user->profile->lastName}}</h3>
        </div>
         <div class="col-md-6">
               <ol class="breadcrumb">
                <li><a href="/admin">Admin Dashboard</a></li>
                <li><a href="/admin/users/">Användare</a></li>
                <li class="active">Användare: {{$user->profile->name . ' ' . $user->profile->lastName}} </li>
               </ol>
               </div>
               <div class="col-md-6">
                <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
               </div>
            </div>
          <div class="row">
            <div clas="col-md-12">
                <ul class="list-inline list-unstyled">
                <li>
                    <a href="/admin/users/{{$user->username}}/edit" class="btn btn-warning btn-sm">Redigera</a>
                </li>
                 <li>
                     {{Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->username]]) }}
                     {{Form::submit('Ta Bort', ['class' => 'btn btn-danger btn-sm'])}}
                     {{Form::close()}}
                 </li>
                 </ul>
             </div>
          </div>
          <div class="row">
          <div class="col-md-12">

            <div class="col-sm-6 well well-sm">
            <h5>Generell info</h5>
                    <ul class="list-unstyled">
                        <li><P>Namn: {{$user->profile->name. ' '. $user->profile->lastName}}</P></li>
                        <li><P>Karaktär: {{$user->username}}</P></li>
                        <li><P>Klass: {{ucfirst($user->profile->klass)}}</P></li>
                        <li><P>Rank: {{$user->profile->rank}}</P></li>
                        <li><P>Server: {{$user->server->server}}</P></li>
                        <li><P>Telefon: @if($user->profile->phone  == '')
                             Denna användaren har inte lagt till ett nummer.
                             @else
                            {{$user->profile->phone}}</P>
                             @endif
                            </li>
                    <li><P>Email: {{$user->email}}</P></li>
                    </ul>
                </div>

                 <div class="col-md-6 well well-sm">
                    <ul class="list-unstyled">
                        <li><p>Forumtrådar: {{count($user->threads)}} st</p></li>
                        <li><p>Foruminlägg: {{count($user->comments)}} st</p></li>
                        <li><p>Signade Raids: {{count($user->raids)}} st</p></li>
                    </ul>
                    </div>
            </div>
          </div>
@stop