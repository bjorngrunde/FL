<?php
use Family\Forms\ForumGroupValidation;
use Illuminate\Routing\Controller;

class ForumsController extends Controller
{
    /**
     * @var ForumGroupValidation
     */
    private $forumGroupValidation;

    public function __construct(ForumGroupValidation $forumGroupValidation)
    {

        $this->forumGroupValidation = $forumGroupValidation;
    }

    public function index()
    {
        $groups = ForumGroup::with('categories', 'threads', 'comments', 'user')->get();
        #$categories = ForumCategory::all();
        return View::make('forum.index', ['groups' => $groups]);
    }

    public function category($id)
    {
        $category = ForumCategory::with('threads', 'comments')->find($id);


        return View::make('forum.category',['category' => $category]);
    }

    public function storeCategory()
    {
        $input = Input::all();

        $this->forumGroupValidation->validate($input);

        $category = new ForumCategory;
        $category->title  = Input::get('title');
        if(!Input::get('subtitle') == '')
        {
            $category->subtitle = Input::get('subtitle');
        }
        $category->group_id = Input::get('id');
        $category->author_id = Auth::user()->id;

        $category->save();

        return Redirect::back()->withFlashMessage('Du har nu lagt till Kategorin "'. $category->title .'"');


    }

    public function thread($id)
    {
        $thread = ForumThread::with('comments')->find($id);
        $author = User::with('profile')->find($thread->author_id);

        return View::make('forum.thread', ['thread' => $thread, 'author' => $author]);

    }
    public function storeGroup()
    {
        $input = Input::all();
        $this->forumGroupValidation->validate($input);

        $group = new ForumGroup;
        $group->title = Input::get('title');
        $group->author_id = Auth::user()->id;
        $group->save();

        return Redirect::back()->withFlashMessage('Du har nu lagt till gruppen: '. $group->title);

    }

    public function deleteGroup($id)
    {
        $group = ForumGroup::find($id);
        if($group == null)
        {
            return Redirect::back()->withFlashMessage('Denna grupp existerar inte!');
        }
        $categories = $group->categories();
        $threads = $group->threads();
        $comments = $group->comments();

        $delCa = true;
        $delTh = true;
        $delCo = true;

        if($categories->count() > 0)
        {
           $delCa = $categories->delete();
        }
        if($threads->count() > 0)
        {
            $delTh = $threads->delete();
        }
        if($comments->count() > 0)
        {
            $delCo = $comments->delete();
        }

        if($delCa && $delCo && $delTh && $group->delete())
        {
        return Redirect::back()->withFlashMessage('Gruppen har nu tagits bort.');
        }
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /forums/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /forums
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /forums/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /forums/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /forums/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /forums/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}