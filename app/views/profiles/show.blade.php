@extends('layouts/home')

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="col-md-12 dark-sh-well" style="background:url(/img/profile/{{$user->profile->klass}}.jpg)no-repeat center center; -webkit-background-size: cover; -moz-background-size:cover; background-size:cover;">
    <div class="col-sm-6">
       <img src="{{$user->profile->thumbnail}}" class="img-responsive img-circle profile-top profile-img-avatar center-block" />
       <h2 class="{{$user->profile->klass}} text-center profile-name">{{$user->username}}<br /><small>{{$user->profile->rank}}</small></h2>
       <div class="col-md-12 text-center">
       <small>Itemlevel: {{$averageItemLevel}} / {{$averageItemLevelEquipped}} </small>
       </div>
    </div>
        <div class="col-sm-6"
             <div class="col-sm-12 ">
                <h6><strong>Talents & Glyphs</strong></h6>
                <ul class="list-inline list-unstyled">
                @foreach($talents as $talent)
                    <li>{{$talent}}</li>
                @endforeach
                </ul>
                 <ul class="list-inline list-unstyled">
                @foreach($glyphs as $glyph)
                    <li>{{$glyph}}</li>
                @endforeach
                </ul>
                 <h6><strong>Utrustning</strong></h6>
                     <ul class="list-inline list-unstyled">
                     @foreach($gear as $item)
                        <li>{{$item}}</li>
                     @endforeach
                 </ul>
            </div>
        </div>
        <div class="col-md-12">
             <ul class="nav nav-pills" role="tablist">
                <li class="active"><a href="#start" role="tab" data-toggle="tab">Profil</a></li>
                <li><a href="#activities" role="tab" data-toggle="tab">Aktiviteter</a></li>
                <li><a href="#alts" role="tab" data-toggle="tab">Alts</a></li>
            </ul>
        </div>
         <div class="col-sm-12 dark-sh-well">
          <div class="tab-content">
             <div role="tabpanel" class="tab-pane active" id="start">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">

                </div>
             </div>
         </div>
         <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="activities">

              </div>
          </div>
          <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="alts">

               </div>
           </div>
        <!-- <div class="col-sm-6 ">
         <h6>Aktivitet</h6>
         <ul class="list-unstyled">
            @foreach($feed as $content)
                <li>{{$content}}</li>
            @endforeach
        </ul>
        </div>
        <div class="col-sm-6">
        <h6>Forum</h6>
            <ul class="list-unstyled">
                @foreach($forumFeed as $forumContent)
                    <li>{{$forumContent}}</li>
                @endforeach
            </ul>
        </div>
     </div>
     <div class="col-sm-12">
        <h6>Raidprogress</h6>
     </div>
    </div>
</div>
</div>-->
@stop