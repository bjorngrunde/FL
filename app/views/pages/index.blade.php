@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-md-8">
    <div class="col-md-12 text-center">
        <h4>Nyheter</h4>
        <hr class="dotted" />
    </div>
    <!-- Blog post -->
    <div class="col-md-12 dark-sh-well-no-radius">
    <div class="col-md-8 col-md-offset-4">
    <h4>Garrosh är superdöd!</h4>
    </div>
        <div class="col-md-4">
            <img src="/img/blogg/test1.jpg" class="img-responsive blog-post-img" />
        </div>
        <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis auctor dolor. Nullam sodales, leo at imperdiet tincidunt,
            leo turpis iaculis purus, id vulputate ipsum augue sed lorem. </p>
        </div>
        <div class="col-md-8 col-md-offset-4">
            <ul class="list-unstyled list-inline">
                <li><span class="fa-comment"></span> 3 Kommentarer</li>
                <li><p><span class="fa-calendar"></span> 28 Okt  av <span class="warrior">Bertius</span></p></li>
            </ul>
        </div>
        <div class="col-md-12">
        </div>
        </div>

         <!-- Blog post -->

            <div class="col-md-12 dark-sh-well-no-radius">
            <div class="col-md-8 col-md-offset-4">
            <h4>Är Zigvids mamma en Warwulf?</h4>
            </div>
                <div class="col-md-4">
                    <img src="/img/blogg/test2.jpg" class="img-responsive blog-post-img" />
                </div>
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis auctor dolor. Nullam sodales, leo at imperdiet tincidunt,
                    leo turpis iaculis purus, id vulputate ipsum augue sed lorem. </p>
                </div>
                <div class="col-md-8 col-md-offset-4">
                    <ul class="list-unstyled list-inline">
                        <li><span class="fui-chat"></span> 137 Kommentarer</li>
                        <li><p><span class="fui-calendar"></span> 23 Okt  av <span class="paladin">Princip</span></p></li>
                    </ul>
                </div>
                <div class="col-md-12">
                </div>
                </div>

         <!-- Blog post -->
            <div class="col-md-12 dark-sh-well-no-radius">
            <div class="col-md-8 col-md-offset-4">
                 <h4>Signa upp i tid, nya regler!</h4>
            </div>
                <div class="col-md-4">
                    <img src="/img/blogg/test3.jpg" class="img-responsive blog-post-img" />
                </div>
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis auctor dolor. Nullam sodales, leo at imperdiet tincidunt,
                    leo turpis iaculis purus, id vulputate ipsum augue sed lorem. </p>
                </div>
                <div class="col-md-8 col-md-offset-4">
                    <ul class="list-unstyled list-inline">
                        <li><span class="fui-chat"></span> 2 Kommentarer</li>
                        <li><p><span class="fui-calendar"></span> 19 Okt  av <span class="warrior">Swingzor</span></p></li>
                    </ul>
                </div>
                <div class="col-md-12">
                </div>
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