@if (!$comments->isEmpty())
	{{-- Lazy eager load the user data for each comment, this is for --}}
	{{-- performance reasons to mitigate against the n+1 query problem --}}
	<?php $comments->load('user'); ?>
	<div class="row">
	<ol class="list-unstyled">
		@foreach ($comments as $comment)
			<li class="comment col-md-12" id="C{{ $comment->id }}">
			<hr class="divider-invisible" />
			<div class="col-sm-3 col-md-2">
			    <img class="img-responsive img-circle border-img" src="{{$comment->user->profile->thumbnail}}" />
			    <p class="{{$comment->user->profile->klass}}">
                    {{{ $comment->user->username }}}
                </p>

                <small>
                    {{ $comment->getDate() }}
                </small>
			</div>
			<div class="col-sm-9 col-md-10">
				<p class="admin-comment-box">
					{{ nl2br(htmlspecialchars($comment->comment, null, 'UTF-8')) }}
				</p>
				</div>
			</li>
		@endforeach
	</ol>
@else
<div class="col-md-12">
	<p class="no-comments text-center">
		{{ trans('laravel-comments::messages.no_comments') }}
	</p>
	</div>
	</div>
@endif