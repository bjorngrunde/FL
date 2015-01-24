@extends('layouts.home')

@section('content')
<div class="row">
<ul class="nav navbar-nav">
        <li {{ (Request::is('gallery') ? 'class="active"' : '') }}>{{ link_to_route('gallery', 'Översikt') }}</li>
        <li {{ (Request::is('gallery/album/create') ? 'class="active"' : '') }}>{{ link_to_route('gallery.album.create', 'Nytt album') }}</li>
        <li {{ (Request::is('gallery/album/*/photo/create') ? 'class="active"' : '') }}>{{ link_to_route('gallery.album.photo.create', 'Nytt foto') }}</li>
    </ul>
    <div class="col-md-12">
@yield('gallerySection')
</div>
</div>

</div>
@stop

@section('javascript')
<script src="../../js/lightbox/jquery.lightbox.min.js" ></script>

<script>
$(document).ready(function() {
	$('a.lightbox').iLightbox({
		type: 'image',
		loop: false,
		arrows: true,
		closeBtn: true,
		title: true,
		href: true, //link to media
		content: true, //html content
		beforeShow: function(a, b) {},
		onShow: function(a, b) {},
		beforeClose: function() {},
		afterClose: function() {},
		onUpdate: function(a) {},
		template: {
			container: '<div class="iLightbox-container"></div>',
			image: '<div class="iLightbox-media"></div>',
			iframe: '<div class="iLightbox-media iLightbox-iframe"></div>',
			title: '<div class="iLightbox-details"></div>',
			error: '<div class="iLightbox-error">The requested content cannot be loaded.<br/>Please try again later.</div>',
			closeBtn: '<a href="#" class="iLightbox-close"></a>',
			prevBtn: '<div class="iLightbox-btnPrev"><a href="javascript:;">Föregående</a></div>',
			nextBtn: '<div class="iLightbox-btnNext"><a href="javascript:;">Nästa</a></div>'
		}
	});
});
</script>
@stop