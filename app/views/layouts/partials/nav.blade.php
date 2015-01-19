<div class="row">

</div>
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
            <span class="sr-only">Toggle navigation</span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-01">

    <ul class="nav navbar-nav navbar-right text-center">
    <li><a href="#"><span class="glyphicon glyphicon-comment"></span> </a> </li>
    <li><li class="dropdown">
    <a href="" class="" data-toggle="dropdown">
    <span class="glyphicon glyphicon-bell"> </span> @if(Auth::user()->notifications()->unread()->count() > 0)<span class="badge badge-notify">{{Auth::user()->notifications()->unread()->count()}}</span> @endif </a>
        <ul class="dropdown-menu" style="min-width: 150px;">
        @foreach(Auth::user()->notifications()->unread()->get() as $notification)
            <li><a href="/notification"><small>{{$notification->body}}</small></a>
                        </li>
        @endforeach

        </ul>
    </li>
    <li>
       <img src="{{ Auth::user()->profile->thumbnail }}" class="img-circle img-nav" />
    </li>
        <li class="dropdown"><a href="#" class="" data-toggle="dropdown"><span class="{{Auth::user()->profile->klass}}">{{Auth::user()->username}}<span class="caret"></span></span> </a>
            <ul class="dropdown-menu">
                <li class="text-center">
                <a href="/profile/{{Auth::user()->username}}">Profil</a></li>
               <li class="text-center">
                {{link_to_route('profile.edit', 'Inställningar', Auth::user()->username)}}</li>

                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare'))
                    <li class="text-center"><a href="/admin">Admin</a></li>
                @endif
                <li class="text-center"><a href="/logout">Logga ut</a></li>
            </ul>
        </li>
    </ul>
     <ul class="nav navbar-nav text-center">
        <li><a href="/dashboard">Hem</a></li>
        <li><a href="#">Nyheter</a></li>
        <li><a href="/flrs">FLRS</a></li>
        <li><a href="/forum/">Forum</a></li>
        <li><a href="#">Guild</a></li>
            </ul>
         </li>
      </ul>
      {{Form::open(['route' => 'searchresult', 'method' => 'GET', 'class' => 'navbar-form navbar-left'])}}
          <div class="form-group">
               <input type="text" class="form-control input-sm" name="auto" id="auto" >
          </div>
                {{Form::submit('Sök', ['class' => 'btn btn-primary btn-sm'])}}
          {{Form::close()}}
    </div>
    </div>
</nav>
