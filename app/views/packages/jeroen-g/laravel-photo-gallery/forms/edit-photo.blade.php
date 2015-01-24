{{ Form::model($photo, array('method' => 'PUT', 'route' => array('gallery.album.photo.update', $photo->album_id, $photo->photo_id))) }}

    <div class="form-group">
        {{ Form::label('photo_name', Lang::get('gallery.name') . ':') }}
        {{ Form::text('photo_name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('photo_path', Lang::get('gallery.path') . ':') }}
        {{ Form::text('photo_path', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('album_id', Lang::choice('gallery.album', 1) . ':') }}
        {{ Form::select('album_id', $dropdown, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('photo_description', Lang::get('gallery.desc') . ':') }}
        {{ Form::textarea('photo_description', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::submit(Lang::get('gallery.submit'), array('class' => 'btn btn-primary')) }}
        {{ link_to_route("gallery.album.photo.show", Lang::get('gallery.cancel'), array($photo->album_id, $photo->photo_id), array('class' => 'btn btn-default')) }}
    </div>

{{ Form::close() }}