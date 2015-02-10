<?php

use JeroenG\LaravelPhotoGallery\Validators as Validators;

class GalleryController extends \JeroenG\LaravelPhotoGallery\Controllers\GalleryController {

	protected $album;

	protected $photo;

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$allAlbums = $this->album->all();
		Return View::make('gallery::index', array('allAlbums' => $allAlbums));
	}
}