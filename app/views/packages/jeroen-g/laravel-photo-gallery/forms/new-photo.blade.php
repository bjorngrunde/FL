@if(Session::has('flash_message'))
<div class="text-center">{{ Session::get('flash_message') }}</div>
@endif
{{ Form::open(array('route' => 'gallery.album.photo.store', 'method' => 'POST', 'files' => true)) }}
        
    <div class="form-group">
        {{ Form::label('photo_name', Lang::get('gallery.name') . ':') }}
        {{ Form::text('photo_name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
    {{Form::select('album_id', $dropdown, ['class' => 'form-control'])}}
    </div>
      <div class="form-group">
            {{ Form::label('photo_path', Lang::get('gallery.path') . ':') }}
            {{ Form::file('photo_path', array('class' => '')) }}
        </div>

    <div class="form-group">
        {{ Form::label('photo_description', Lang::get('gallery.desc') . ':') }}
        {{ Form::textarea('photo_description', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn btn-primary')) }}
    </div>

{{ Form::close() }}