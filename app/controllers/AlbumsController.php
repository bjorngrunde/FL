<?php

use JeroenG\LaravelPhotoGallery\Validators as Validators;

class AlbumsController extends \JeroenG\LaravelPhotoGallery\Controllers\AlbumsController
{
    protected $album;

    protected $photo;

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $data = array('type' => 'album');
        Return View::make('gallery::new', $data)
            ->nest('form', 'gallery::forms.new-album');
    }


    public function store()
    {
        $input = Input::all();

        $validation = new Validators\Album;

        if ($validation->passes())
        {
            $filename = str_random(4) . Input::file('thumbnail')->getClientOriginalName();
            Image::make(Input::file('thumbnail'))->resize(300, 200)->save('default/public/uploads/thumbnails/'. $filename);

            #$destination = "uploads/thumbnails/";
            #$upload = Input::file('thumbnail')->move($destination, $filename);

           /* if ($upload == false)
            {
                return Redirect::to('gallery.album.create')
                    ->withInput()
                    ->withErrors($validation->errors)
                    ->with('message', Lang::get('gallery::gallery.errors'));
            }
*/
            $this->album->create($input, $filename);
            return Redirect::route('gallery')
                ->with('flash_message', Lang::get('gallery::gallery.success'));
        }
        else
        {
            return Redirect::back()
                ->withInput()
                ->withErrors($validation->errors)
                ->with('flash_message', Lang::get('gallery::gallery.errors'));
        }
	}

	public function show($id)
	{
		$album = $this->album->findOrFail($id);
		$albumPhotos = $this->photo->findByAlbumId($id);
		return View::make('gallery::album', array('album' => $album, 'albumPhotos' => $albumPhotos));
	}

	public function edit($id)
	{
		$album = $this->album->find($id);

		if(is_null($id))
		{
			return \Redirect::to('gallery');
		}

		$data = array('type' => 'album', 'album' => $album);
		return View::make('gallery::edit', $data)
		->nest('form', 'gallery::forms.edit-album', $data);
	}

	public function update($id)
	{
		$input = \Input::except('_method');

        $validation = new Validators\Album($input);

        if ($validation->passes())
        {
            $this->album->update($id, $input);

            return Redirect::route('gallery.album.show', array('id' => $id));
        }
        else
        {
        	return Redirect::route('gallery.album.edit', array('id' => $id))
            ->withInput()
            ->withErrors($validation->errors)
            ->with('message', \Lang::get('gallery::gallery.errors'));
        }
	}

	public function destroy($id)
	{
		$this->album->delete($id);
        return Redirect::route("gallery");
	}
}