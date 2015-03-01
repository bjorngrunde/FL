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
                    <ul class="list-unstyled">
                        <li><h6>Karaktär:</h6><h4> {{$user->username}}</h4></li>
                        <li><h6>Klass:<h6><h4>{{ucfirst($user->profile->klass)}}</h4></li>
                        <li><h6>Rank:</h6><h4> {{$user->profile->rank}}</h4></li>
                        <li><h6>Server:</h6><h4> {{$user->server->server}}</h4></li>
                        <li><h6>Telefon:</h6> @if($user->profile->phone  == '')
                            <h4> Denna användaren har inte lagt till ett nummer.</h4>
                             @else
                          <h4>  {{$user->profile->phone}}</h4>
                             @endif
                            </li>
                         <li><h6>Email:</h6><h4> {{$user->email}}</h4></li>
                    </ul>
                </div>
                 <div class="col-md-6">
                    <ul class="list-unstyled list-inline">
                        <li>
                            <div class="col-sm-3 text-center">
                            <h5>Trådar</h5>
                            <i class="fa fa-pencil-square fa-5x"></i>
                            <h3>{{count($user->threads)}}</h3>
                            </div>
                            </li>
                        <li>
                            <div class="col-sm-3 text-center">
                            <h5>Inlägg</h5>
                            <i class="fa fa-comments fa-5x"></i>
                            <h3>{{count($user->comments)}}</h3>
                            </div>
                        </li>
                        <li class="text-center">
                            <div class="col-sm-3">
                            <h5>Raids</h5>
                            <i class="fa fa-calendar fa-5x"></i>
                            <h3>{{count($user->raids)}}</h3>
                            </div>
                        </li>
                        <li>
                            <div class="col-sm-3 text-center">
                            <h5>Nyheter</h5>
                            <i class="fa fa-comments fa-5x"></i>
                            <h3>{{count($user->posts)}}</h3>
                            </div>
                        </li>
                    </ul>
                 <div class="col-md-12 text-center">
                    <h4>Beräkna närvaro</h4>
                    {{Form::open(['method' => 'POST','route' => ['stats.attendance', $user->id],'class' => 'form-inline', 'id' => 'attendance'])}}
                    {{Form::label('date1', 'Från')}}
                    {{Form::text('date1', null, ['class' => 'date1 form-control input-sm', 'id' => 'date1'])}}
                    {{Form::label('date2', 'Till')}}
                    {{Form::text('date2', null, ['class' => 'date2 form-control input-sm', 'id' => 'date2'])}}
                    {{Form::submit('Kolla närvaro', ['class' => 'btn btn-primary btn-sm'])}}
                    {{Form::close()}}
                 </div>

                 <div class="col-md-12 text-center" id="result">

                 </div>
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

@section('javascript')
<script src="/js/Chart.min.js"></script>

<script>
        $('.date1').pickadate();
        $('.date2').pickadate();
    </script>
<script>
jQuery(document).ready(function($) {

    $('#attendance').on('submit',function(){
        $('.fa-spinner').remove();
        $('.percent-calc').remove();
        $('#result').append('<br /><br/><i class="fa fa-spinner fa-spin"></i>');
        $.post(
            $(this).prop('action'),
            {
                "date1": $('#date1').val(),
                "date2": $('#date2').val()
            },
            function(data)
            {
                if(data['msg'] == 'success')
                {
                    $('.fa-spinner').remove();
                    $("#result").html('<h1 class="percent-calc">'+ data['percentage'] +'</h1><h5 class="percent-calc">Under denna period var det totalt <b>' + data["totalRaids"] + '</b> st raids. <br /> {{$user->profile->name}} {{$user->profile->lastName}} har deltagit i <b>' + data["totalUserRaids"] + '</b> st raids. <br /> Vilket resulterar i en närvaro på <b>' + data['percentage'] +  '</b></h5>')
                }
            }, 'json'
        );

        return false;
    });
});
</script>

@stop