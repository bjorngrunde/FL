@extends('...layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="text-center">
    <h5>Ansökningar listas här.</h5>
    @if(Session::has('flash_message'))
    <p class="text-success">{{Session::get('flash_message')}}</p>
    @else
    <p>Här kan du godkänna eller neka en ansökan. De kan också redigeras, eller tas bort helt.</p>
    @endif
    </div>
    </div>
    <div class="col-md-12">
        <table class="table table-hover">
            <tr>
                <th>Namn </th>
                <th>Karaktär</th>
                <th>Status</th>
                <th>Kommentarer</th>
                <th>Visa</th>
                <th>Redigera</th>
                <th>Ta bort</th>
            </tr>
            <tbody>
            @if(isset($applications))
                @foreach($applications as $application)
                <tr>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->username }}</td>
                    <td>
                     @if (!empty($application->status))
                        @if($application->status->app_status == 'default')
                             Väntar på beslut
                        @elseif($application->status->app_status =='denied')
                             Nekad
                         @elseif($application->status->app_status == 'approved')
                            Accepterad
                         @endif
                     @else
                       <p>Ingens status hittades</p>
                     @endif
                    <td>{{count($application->comments)}}</td>
                    <td><a href="/admin/applications/{{$application->id}}" class="btn btn-primary btn-sm"> Visa</a></td>
                    <td><a href="/admin/applications/{{$application->id}}/edit" class="btn btn-warning btn-sm"> Redigera</a> </td>
                    <td>
                    {{Form::open(['method' => 'DELETE', 'route' => ['application.destroy', $application->id]]) }}
                    {{Form::submit('Ta Bort', ['class' => 'btn btn-danger btn-sm'])}}
                    {{Form::close()}}
                    </td>
                </tr>
               @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="col-sm-12">
           {{ $applications->links(); }}
    </div>
</div>
@stop