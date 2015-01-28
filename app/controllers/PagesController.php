<?php


class PagesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /pages
	 *
	 * @return Response
	 */
	public function index()
    {
        $allRaids = Raid::orderBy('created_at', 'asc')->get();
        $raids = $allRaids->take(3);

        $forumthreads = ForumThread::with('comments', 'group')->orderBy('updated_at', 'desc')->get();
        $threads = $forumthreads->take(6);
        $posts = Post::with('user')->orderBy('id', 'desc')->paginate(3);

        $gallery = Photo::orderBy('created_at', 'desc')->get();
        $photos = $gallery->take(6);

		Return View::make('pages.index', compact('posts'),['raids' => $raids, 'threads' => $threads, 'photos' => $photos]);
	}
}