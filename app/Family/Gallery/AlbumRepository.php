<?php namespace Family\Gallery;

interface AlbumRepository {
	
	public function all();

	public function find($id);

	public function findOrFail($id);

	public function create($input, $filename);

	public function update($id, $input);

	public function delete($id);

	public function forceDelete($id);

	public function restore($id);
}