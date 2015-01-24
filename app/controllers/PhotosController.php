<?php

use JeroenG\LaravelPhotoGallery\Validators as Validators;


class PhotosController extends \JeroenG\LaravelPhotoGallery\Controllers\PhotosController {

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
	 * Show the form for creating a new photo.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$albumArray = Album::whereUser_id(Auth::user()->id)->get();
		$dropdown[0] = '';

		if (empty($albumArray)) {
			$dropdown[0] = Lang::get('gallery.none') . Lang::choice('gallery.album', 2);
		}

		foreach ($albumArray as $album) {
		    $dropdown[$album['album_id']] = $album['album_name'];
		}

		$data = array('type' => 'photo', 'dropdown' => $dropdown);
		return View::make('gallery::new', $data)
		->nest('form', 'gallery::forms.new-photo', $data);
	}

	/**
	 * Store a newly created photo in storage.
	 *
	 * @return \Illuminate\View\View
	 */
	public function store()
	{
		$input = Input::all();

		$validation = new Validators\Photo;

		if($validation->passes())
		{
			$filename = str_random(4) . Input::file('photo_path')->getClientOriginalName();
			Image::make(Input::file('photo_path'))->save('uploads/photos/'. $filename);
            Image::make(Input::file('photo_path'))->resize(300,200)->save('uploads/thumbnails/'. $filename);

           /* $upload = Input::file('photo_path')->move($destination, $filename);

			if( $upload == false )
			{
				return Redirect::to('gallery.album.photo.create')
       			->withInput()
       			->withErrors($validation->errors)
       			->with('message', \Lang::get('gallery::gallery.errors'));
			} */

			$this->photo->create($input, $filename);
			return Redirect::route("gallery.album.show", array('id' => $input['album_id']));
		}
		else
		{
			return Redirect::route('gallery.album.photo.create')
            ->withInput()->withErrors($validation->errors)
            ->with('message', \Lang::get('gallery::gallery.errors'));
		}
	}

	/**
	 * Display the specified photo.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function show($albumId, $photoId)
	{
		$photo = $this->photo->findOrFail($photoId);
		return View::make('gallery::photo', array('photo' => $photo));
	}

	/**
	 * Show the form for editing the specified photo.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function edit($albumId, $photoId)
	{
		$photo = $this->photo->find($photoId);

		$albumArray = $this->album->all()->toArray();
		foreach ($albumArray as $album) {
		    $dropdown[$album['album_id']] = $album['album_name'];
		}

		$data = array('type' => 'photo', 'dropdown' => $dropdown, 'photo' => $photo);
		return View::make('gallery::edit', $data)
		->nest('form', 'gallery::forms.edit-photo', $data);
	}

	/**
	 * Update the specified photo in the database.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function update($albumId, $photoId)
	{
		$input = Input::except('_method');

        $validation = new Validators\Photo($input);

        if ($validation->passes())
        {
            $this->photo->update($photoId, $input);

            return Redirect::route("gallery.album.photo.show", array('albumId' => $albumId, 'photoId' => $photoId));
        }
        else
        {
        	return Redirect::route("gallery.album.photo.edit", array('albumId' => $albumId, 'photoId' => $photoId))
            ->withInput()
            ->withErrors($validation->errors)
            ->with('message', \Lang::get('gallery::gallery.errors'));
        }
	}

	/**
	 * Remove the specified photo from the database.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function destroy($albumId, $photoId)
	{
        $this->photo->delete($photoId);
        return Redirect::route("gallery.album.show", array('id' => $albumId));
	}
}