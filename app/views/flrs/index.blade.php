@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="col-md-12 dark-sh-well">
        {{$cal->generate()}}
    </div>
    <div class="col-sm-12 col-md-12">
        <h6 class="text-center">Kommande Raids!</h6>
        <div class="table-responsive">
            <table class="table">
                <tr>
                <th>Raid</th>
                <th>Tier</th>
                <th>Datum</th>
                <th>Start</th>
                <th>Slut</th>
                <th>Signad</th>
                </tr>
                <tbody>
                    @foreach($raids as $raid)
                    <tr>
                        <td><p>{{$raid->title}}</p></td>
                        <td><p>{{$raid->mode}}</p></td>
                        <td><p>{{$raid->time}}</p></td>
                        <td><p>{{$raid->startTime}}</p></td>
                        <td><p>{{$raid->endTime}}</p></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class=""
    </div>
    </div>
</div>

@stop