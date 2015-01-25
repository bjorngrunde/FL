@extends('layouts.admin')

@section('content')
<div class="row">
<div class="col-md-12">
    <h3 class="text-center">Hantera användare</h3>
</div>
 <div class="col-md-6">
       <ol class="breadcrumb">
        <li><a href="/admin">Admin Dashboard</a></li>
        <li class="active">Användare</li>
       </ol>
       </div>
       <div class="col-md-6">
        <a href="/admin" class="btn btn-primary btn-sm pull-right">Admin Dashboard</a>
       </div>
    </div>
    <div class="col-md-12">
        <table class="table hover">
            <tr>
                <th>Förnamn</th>
                <th>Efternamn</th>
                <th>Användarnamn</th>
                <th>Email</th>
                <th>Åtgärd</th>
            </tr>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->profile->name}}</td>
                        <td>{{$user->profile->lastName}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="/admin/users/{{$user->id}}"> Visa</a></td>
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