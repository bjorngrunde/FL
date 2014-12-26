<div class="row">
<div class="comments">
<div class="col-md-12 text-center">
	<h5 class="comments--title">
		{{ trans('laravel-comments::messages.comments_heading') }}
	</h5>
	@if (!$comments->isEmpty())
		<p class="comments--add--link">
			<a href="#{{ trans('laravel-comments::messages.add_form_anchor') }}">
				{{ trans('laravel-comments::messages.add_form_link_text') }}
			</a>
		</p>
	@endif
</div>
	@include ('laravel-comments::list')

	{{-- If you are not using this file, add this anchor to your view --}}
	{{-- as this is the point that the controller redirect users back to --}}
	<div class="col-md-12">
	<h4 class="text-center" id="{{ trans('laravel-comments::messages.add_form_anchor') }}">

		{{ trans('laravel-comments::messages.add_comment_heading') }}
	</h4>
    </div>
	@if (Session::has('laravel-comments::error'))
		<p class="comments--error">
			{{ Session::get('laravel-comments::error') }}
		</p>
	@endif

	@if (Auth::check())

		@include ('laravel-comments::form')

	@else

		<p class="comments--login--required">
			{{ trans('laravel-comments::messages.login_required') }}
			<a href="{{ action('UserController@showLogin') }}?return={{ urlencode(Request::url()) }}" class="btn">
				{{ trans('laravel-comments::messages.login_btn_text') }}
			</a>
			<a href="{{ action('UserController@showRegister') }}?return={{ urlencode(Request::url()) }}" class="btn">
				{{ trans('laravel-comments::messages.register_btn_text') }}
			</a>
		</p>

	@endif
</div>
</div>