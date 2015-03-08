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
        $allRaids = Raid::where('time', '>=', date('y-m-d'))->orderBy('created_at', 'asc')->get();
        $raids = $allRaids->take(3);

        $forum = Notification::whereObject_type('ForumThread', 'ForumComment')->orderBy('created_at', 'desc')->take(15)->get();

        $posts = Post::with('user')->orderBy('id', 'desc')->paginate(3);

        $gallery = Photo::orderBy('created_at', 'desc')->get();
        $photos = $gallery->take(6);

		Return View::make('pages.index', compact('posts'),['raids' => $raids, 'forum' => $forum, 'photos' => $photos]);
	}
}