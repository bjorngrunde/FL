@extends('layouts.gallery')
@section('gallerySection')

	<div class="row">
	<div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <b>{{ Lang::get('gallery.overview') . ' ' . Lang::choice('gallery.album', 2) }}</b>
            </div>
            <div class="panel-body">
                @if ($allAlbums->count())
                    <ul class="list-unstyled list-inline">
                    @foreach($allAlbums as $album)
                    <li class="col-sm-3">
                        <div class="dark-sh-well-no-radius">
                        <img src="{{$album->thumbnail}}" class="img-responsive">
                        <dt>{{ link_to_route("gallery.album.show", $album->album_name, array($album->album_id)) }}</dt>
                       <small class="">{{ $album->album_description }} <br /> Ägare: <span class="{{$album->user->profile->klass}}"> {{$album->user->username}}</span></small>
                        </div>
                        </li>
                    @endforeach
                    </ul>

                    </dl>
            	@else
                	<b>{{ Lang::get('gallery::gallery.none') . Lang::choice('gallery::gallery.album', 2) }}</b>
            	@endif
            </div>
        </div>
        </div>
    </div>
    
@stop