@extends('layouts.admin')

@section('content')
<div class="row">
<div class="col-md-12">
    <h4 class="text-center">Hantera användare</h4>
    @if(Session::has('flash_message'))
        <P class="text-success text-center">{{Session::get('flash_message')}}</P>
    @endif
</div>
    <div class="col-md-12">
        <table class="table hover">
            <tr>
                <th>Användarnamn</th>
                <th>Email</th>
                <th>Redigera</th>
                <th>Ta bort</th>
            </tr>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="/admin/users/{{$user->username}}/edit" class="btn btn-warning btn-sm">Redigera</a></td>
                         <td>{{Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->username]]) }}
                             {{Form::submit('Ta Bort', ['class' => 'btn btn-danger btn-sm'])}}
                             {{Form::close()}}
                         </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
        {{$users->links()}}
        </div>
    </div>
</div>
@stop