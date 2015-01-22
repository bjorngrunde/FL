@extends('layouts.home')

@section('content')
<div class="row">
<ul class="nav navbar-nav">
        <li {{ (Request::is('gallery') ? 'class="active"' : '') }}>{{ link_to_route('gallery', 'Home') }}</li>
        <li {{ (Request::is('gallery/album/create') ? 'class="active"' : '') }}>{{ link_to_route('gallery.album.create', 'New album') }}</li>
        <li {{ (Request::is('gallery/album/*/photo/create') ? 'class="active"' : '') }}>{{ link_to_route('gallery.album.photo.create', 'Add photo') }}</li>
    </ul>
    <div class="col-md-12">
@yield('gallerySection')
</div>
</div>

</div>
@stop