@extends('layouts.gallery')
@section('gallerySection')

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ $photo->photo_name }}</b>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="/gallery/album/{{$photo->album_id}}">{{ Lang::get('gallery.return') }}</a>
            </div>
        </div>
        <div class="panel-body">
            <img class="img-responsive" src='{{asset('/uploads/photos/'.$photo->photo_path) }}' />
        </div>
        <div class="col-sm-12 clearfix">
    	    {{ $photo->photo_description }}
    	    </div>
    	    <div class="col-md-12">
    	    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare') || Auth::user()->id == $photo->photo_id)
            {{ Form::open(array('route' => array("gallery.album.photo.destroy", $photo->album_id, $photo->photo_id))) }}
            <div class="form-group">
                    {{ link_to_route("gallery.album.photo.edit", Lang::get('gallery.edit'), array('albumId' => $photo->album_id, 'photoId' => $photo->photo_id), array('class' => 'btn btn-info btn-sm')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit(Lang::get('gallery.delete'), array('class' => 'btn btn-danger btn-sm')) }}
                {{ Form::close() }}
            @endif
                </div>
        </div>
    </div>
    <div class="col-md-12">
      @include('laravel-comments::comments', ['commentable' => $photo, 'comments' => $photo->comments])
    </div>
</div>
	
@stop