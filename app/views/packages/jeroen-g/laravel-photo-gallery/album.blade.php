@extends('layouts.gallery')
@section('gallerySection')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ Lang::get('gallery.overview') . ' ' . Lang::choice('gallery.album', 1) . ': ' . $album->album_name }}</b>
            <div class="pull-right">
              @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare') || Auth::id() == $album->user_id)
                {{ Form::open(array('route' => array("gallery.album.destroy", $album->album_id))) }}
                    {{ link_to_route("gallery.album.edit", Lang::get('gallery.edit'), array('id' => $album->album_id), array('class' => 'btn btn-info btn-sm')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit(Lang::get('gallery.delete'), array('class' => 'btn btn-danger btn-sm')) }}
                {{ Form::close() }}
             @endif
            </div>
        </div>
        <div class="panel-body">

        @if($albumPhotos->count())
            <div class="row">
            <ul class="list-inline list-unstyled">
            @foreach($albumPhotos as $photo)
               <li> <div class="col-sm-4 text-center">
                    <a href="{{ asset('uploads/photos/' .$photo->thumbnail)}}" data-lightbox-gallery="{{$album->album_name}}" data-lightbox-title="{{$photo->photo_name}}" class="lightbox">
                    <img src="{{asset('uploads/thumbnails/'. $photo->thumbnail)}}" class="img-responsive"/> </a>
                    <a href="/gallery/album/{{$album->album_id}}/photo/{{$photo->photo_id}}"><h5>{{$photo->photo_name}}</h5></a></b>
                    <small>{{$photo->photo_description}}</small>

                </div></li>
    		@endforeach
    		</ul>
            </div>
        </div>
        <div class="col-md-12">
    	   <?php echo $albumPhotos->links(); ?>
        </div>
    	@else
        	{{ Lang::get('gallery.none') . Lang::choice('gallery.photo', 2) }}
            </div>
    	@endif

        <div class="col-md-12">

         @include('laravel-comments::comments', ['commentable' => $album, 'comments' => $album->comments])
        </div>
    </div>
@stop