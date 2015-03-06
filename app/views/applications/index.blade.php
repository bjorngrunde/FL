@extends('...layouts.admin')

@section('content')
<div class="row">
<div class="col-md-12 text-center">
<h3>Hantera Ansökningar</h3>
</div>
    <div class="col-md-6">
   <ol class="breadcrumb">
    <li><a href="/admin">Admin Dashboard</a></li>
    <li class="active">Ansökningar</li>
   </ol>
   </div>
   <div class="col-md-6">
    <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
   </div>
    </div>
    <div class="col-md-12">
        <table class="table table-hover">
            <tr>
                <th><p>#</p></th>
                <th><p>Namn</p></th>
                <th><p>Efternamn</p></th>
                <th><p>Status</p></th>
                <th><p>Kommentarer</p></th>
                <th><p>Åtgärd</p></th>
            </tr>
            <tbody>
            @if(isset($applications))
                @foreach($applications as $application)
                <tr>
                    <td>{{$application->id}}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->lastName }}</td>
                    <td>
                     @if (!empty($application->status))
                        @if($application->status->app_status == 'default')
                             <p class="text-info"> Väntar på beslut</p>
                        @elseif($application->status->app_status =='denied')
                             <p class="text-danger">Nekad</p>
                         @elseif($application->status->app_status == 'approved')
                           <p class="text-success"> Accepterad </p>
                         @endif
                     @else
                       <p>Ingens status hittades</p>
                     @endif
                    <td>{{count($application->comments)}}</td>
                    <td><a href="/admin/applications/{{$application->id}}">Visa</a></td>
                </tr>
               @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="col-sm-12 text-center">
           {{ $applications->links(); }}
    </div>
</div>
@stop