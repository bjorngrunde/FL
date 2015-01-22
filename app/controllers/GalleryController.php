<?php

use JeroenG\LaravelPhotoGallery\Validators as Validators;

class GalleryController extends \JeroenG\LaravelPhotoGallery\Controllers\GalleryController {

	/**
	 * The album model
	 *
	 * @var \JeroenG\LaravelPhotoGallery\Models\Album
	 **/
	protected $album;

	/**
	 * The photo model
	 *
	 * @var \JeroenG\LaravelPhotoGallery\Models\Photo
	 **/
	protected $photo;

	/**
	 * Instantiate the controller
	 *
	 * @param \JeroenG\LaravelPhotoGallery\Models\Album $album
	 * @param \JeroenG\LaravelPhotoGallery\Models\Photo $photo
	 * @return void
	 **/
	public function __construct()
    {
        parent::__construct();
    }

    /**
	 * Methods for showing
     **/

	/**
	 * Listing all albums
	 *
	 * @return \Illuminate\View\View
	 **/
	public function index()
	{
		$allAlbums = $this->album->all();
		Return View::make('gallery::index', array('allAlbums' => $allAlbums));
	}
}