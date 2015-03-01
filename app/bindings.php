<?php

$this->app->bind('Repositories\PhotoRepository', 'Family\Gallery\EloquentPhotoRepository');

$this->app->bind('Repositories\AlbumRepository', 'Family\Gallery\EloquentAlbumRepository');
