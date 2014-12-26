@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-md-8">
    <div class="col-md-12 text-center">
        <h4>Nyheter</h4>
        <hr class="dotted" />
    </div>
    <!-- Blog post -->
    @foreach($posts as $post)
    <div class="col-md-12 dark-sh-well-no-radius">
    <div class="col-md-8 col-md-offset-4">
    <h4><a href="/news/post/{{$post->id}}">{{$post->title}}</a></h4>
    </div>
    @if(!empty($post->thumbnail))
        <div class="col-md-4">
            <img src="{{$post->thumbnail}}" class="img-responsive blog-post-img" />
        </div>
    @endif
        <div class="col-md-8">
            {{Str::limit($post->body, 200)}}
        </div>
        <div class="col-md-8 col-md-offset-4">
            <ul class="list-unstyled list-inline">
                <li><span class="fa-comment"></span> {{count($post->comments)}} Kommentarer</li>
                <li><p><span class="fa-calendar"></span> Skriven av: <span class="{{$post->user->profile->klass}}">{{$post->user->username}}</span></p></li>
            </ul>
        </div>
        <div class="col-md-12">
        {{$posts->links()}}
        </div>
        </div>
    @endforeach

    <div class="col-md-12">
    {{$posts->links()}}
    </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12 text-center">
            <h4>Aktiviteter</h4>
            <hr class="dotted" />
        </div>
        <div class="col-md-12 dark-sh-well-no-radius">
                <p><span class="rogue">Varah</span> har lämnat en kommentar på <span class="text-info">Är Zigvids mamma en Warwulf?</span> </p>
                <hr class="divider-invisible" />
                <p><span class="shaman">Loké</span> har anmält sig till <span class="text-info">Siege of Orgrimmar (Mythic)</span> 30 Okt, 19:30</p>
                <hr class="divider-invisible" />
                <p><span class="warlock">Feariar</span> har anmält sig till <span class="text-info">Siege of Orgrimmar (Mythic)</span> 30 Okt, 19:30</p>
                <hr class="divider-invisible" />
                <p><span class="monk">Miltón</span> har skapat en tråden <span class="text-info">Det är inte gay, om man tar emot??</span></p>
                <hr class="divider-invisible" />
                <p><span class="shaman">Zigvid</span> har lämnat en kommentar på <span class="text-info">Är Zigvids mamma en Warwulf?</span> </p>
                <hr class="divider-invisible" />
        </div>
        <div class="col-md-12">
        <div class="col-md-12 text-center">
            <h5>Datum</h5>
            <hr class="dotted"/>
        </div>
         @foreach($raids as $raid)
         <a href="flrs/show/{{$raid->id}}" class="raid-timer-link">
        <div class="col-md-12 dark-sh-well-no-radius" style="background:url({{$raid->backgroundImg}}) no-repeat center center; background-size: cover;">

            <div class="col-md-5">
                <p class="text-white">{{$raid->time}}</p>
            </div>
            <div class="col-md-7">
                <p class="text-white">{{$raid->title}} <small>{{$raid->mode}}</small></p>
            </div>
            <hr class="divider-invisible" />
        </div>
        </a>
        @endforeach
        </div>
    </div>
</div>
@stop