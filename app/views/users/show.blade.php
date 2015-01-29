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

            <div class="col-sm-6">
            <h4>{{$user->profile->name. ' '. $user->profile->lastName}}</h4>
                    <ul class="list-unstyled">
                        <li><h5>Karaktär: {{$user->username}}</h5></li>
                        <li><h5>Klass: {{ucfirst($user->profile->klass)}}</h5></li>
                        <li><h5>Rank: {{$user->profile->rank}}</h5></li>
                        <li><h5>Server: {{$user->server->server}}</h5></li>
                        <li><h5>Telefon: @if($user->profile->phone  == '')
                             Denna användaren har inte lagt till ett nummer.
                             @else
                            {{$user->profile->phone}}</h5>
                             @endif
                            </li>
                    <li><h5>Email: {{$user->email}}</h5></li>
                    <li><h5>Forumtrådar: {{count($user->threads)}} st</h5></li>
                    <li><h5>Foruminlägg: {{count($user->comments)}} st</h5></li>
                    <li><h5>Signade Raids: {{count($user->raids)}} st</h5></li>
                    </ul>
                </div>

                 <div class="col-md-6">
                    <h4>Statistik</h4>
                    </div>
            </div>
            <div class="col-md-12">

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