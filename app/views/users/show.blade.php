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
                 <a id="{{$user->id}}" href="#" class="btn btn-danger btn-sm delete_user" data-toggle="modal" data-target="#user_delete">Ta bort</a>
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

          <div class="modal fade" id="user_delete" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">
                                      <span aria-hidden="true">&times;</span>
                                      <span class="sr-only">Close</span>
                                      </button>
                                      <h4 class="modal-title">Ta bort användaren {{$user->username}} ?</h4>
                                  </div>
                                  <div class="modal-body">
                                      <p>Är du säker på att du vill ta bort denna användare? <br /> <small>All data som användaren skapat kommer också försvinna.</small> </p>
                                  </div>
                                  <div class="modal-footer">
                                       <div class="form-group">
                                      {{Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->username]]) }}
                                      <button type="button" class=" btn btn-primary btn-sm" data-dismiss="modal">Stäng</button>
                                       {{Form::submit('Ta Bort', ['class' => 'btn btn-danger btn-sm'])}}
                                       {{Form::close()}}
                                       </div>
                                  </div>
                              </div>
                          </div>
                      </div>
@stop