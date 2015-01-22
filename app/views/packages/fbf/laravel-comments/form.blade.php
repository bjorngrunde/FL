<div class="row">
<div class="col-md-8 col-md-offset-2">
{{ Form::open(array('action' => array('Fbf\LaravelComments\CommentsController@create'), 'class' => 'form__comment')) }}

	{{-- This is used to return the user back to this page --}}
	{{ Form::hidden('return', Request::url()) }}

	{{-- This is used to ensure the comment is added to the right commentable object --}}
	{{ Form::hidden('commentable', Crypt::encrypt(get_class($commentable) . '.' . $commentable->getKey())) }}

	<div class="form-group{{ $errors->has('comment') ? ' form--group__error' : '' }}">

		{{ Form::textarea('comment', Input::old('comment'), array('placeholder' => trans('laravel-comments::messages.form.placeholder'), 'required' => 'required', 'class' => 'form-control')) }}
		@if ($errors->has('comment'))
			<p class="form-error">
				{{ $errors->first('comment') }}
			</p>
		@endif
	</div>

	<div class="form-group text-center">
		{{ Form::submit(trans('laravel-comments::messages.form.submit'), array('class' => 'btn btn-primary btn-sm')) }}
	</div>

{{ Form::close() }}
</div>
</div>