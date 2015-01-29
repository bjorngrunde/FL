@extends('layouts.home')

@section('content')

<div class="row">
    <div class="panel panel-default text-center">
    <div class="panel-heading">
    <ul class="list-unstyled list-inline">
       <li>
       <label for="klass">Filtrera efter klass</label>
       <select name="klass">
        <option class="filter" data-filter=".category-all">Alla</option>
        <option class="filter" data-filter=".category-death-knight">Death Knight</option>
        <option class="filter" data-filter=".category-druid">Druid</option>
        <option class="filter" data-filter=".category-hunter">Hunter</option>
        <option class="filter" data-filter=".category-mage">Mage</option>
        <option class="filter" data-filter=".category-monk">Monk</option>
        <option class="filter" data-filter=".category-priest">Priest</option>
        <option class="filter" data-filter=".category-paladin">Paladin</option>
        <option class="filter" data-filter=".category-rogue">Rogue</option>
        <option class="filter" data-filter=".category-shaman">Shaman</option>
        <option class="filter" data-filter=".category-warlock">Warlock</option>
        <option class="filter" data-filter=".category-warrior">Warrior</option>
       </select>
       </li>
       <li>
       <label for="rank">Filtrera efter rank</label>
        <select name="rank">
            <option class="filter" data-filter=".category-all">Alla</option>
            <option class="filter" data-filter=".category-Guild-Master">Guild Master</option>
            <option class="filter" data-filter=".category-Officer">Officer</option>
            <option class="filter" data-filter=".category-Raider">Raider</option>
            <option class="filter" data-filter=".category-Social">Social</option>
            <option class="filter" data-filter=".category-Trial">Trial</option>
        </select>
       </li>
       <li>
        <button class="sort btn btn-primary" data-sort="name:asc"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button>
        <button class="sort btn btn-primary" data-sort="name:desc"><span class="glyphicon glyphicon-sort-by-alphabet-alt "></span></button>
       </li>
    </ul>
    </div>
        <div class="panel-body">
     <ul id="Container" class="list-inline list-unstyled">
        @foreach($users as $user)
        <li  class="mix category-{{$user->profile->klass}} category-all category-{{str_replace(' ', '-', $user->profile->rank) }}" data-klass="{{$user->profile->klass}}" data-name="{{$user->username}}">
            <img src="{{$user->profile->thumbnail}}" class="img-circle img-nav center-block" />
            <a href="/profile/{{$user->username}}"><span class="{{$user->profile->klass}}"><p>{{$user->username}}</p></span></a>
        </li>
        @endforeach
        </ul>
    </div>
</div>
</div>

@stop

@section('javascript')
<script src="/js/jquery.mixitup.min.js"></script>
<script>
$(function(){
    $('#Container').mixItUp();
});
</script>
@stop