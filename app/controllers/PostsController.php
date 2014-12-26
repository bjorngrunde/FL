<?php

use Family\Forms\PostsForm;
use Illuminate\Routing\Controller;

class PostsController extends Controller
{
    /**
     * @var PostsForm
     */
    private $postsForm;

    /**
     * @param PostsForm $postsForm
     */
    public function __construct(PostsForm $postsForm)
    {

        $this->postsForm = $postsForm;
    }
    public function index()
    {
        $posts = Post::with('user')->orderBy('id', 'desc')->paginate(25);

        return View::make('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with('user')->whereId($id)->firstOrFail();

        return View::make('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return View::make('posts.create');
    }

    public function edit($id)
    {
        $post = Post::with('user')->whereId($id)->firstOrFail();
        return View::make('posts.edit', ['post' => $post]);
    }

    public function update($id)
    {
        $input = Input::all();
        $this->postsForm->validate($input);

        $post = Post::find($id);
        $post->title = Input::get('title');
        $post->body = Input::get('body');
        $post->user_id = Auth::user()->id;

        if(Input::hasFile('img'))
        {
            $thumbnailName = time(). '-thumbnail-post.jpg';

            $thumbnail = Image::make(Input::file('img'));
            $thumbnail->resize(300, 200);
            $thumbnail->save('img/posts/'.$thumbnailName);

            $imageName =time(). '-post.jpg';
            $image = Image::make(Input::file('img'));
            $image->save('img/posts/'.$imageName);

            $post->thumbnail = '/img/posts/'.$thumbnailName;
            $post->img  = '/img/posts/'.$imageName;
        }

        $post->save();

        return Redirect::back()->withFlashMessage('Ditt inlägg har redigerats');

    }

    public function store()
    {
        $input = Input::all();
        $this->postsForm->validate($input);

        $post = new Post;
        $post->title = Input::get('title');
        $post->body = Input::get('body');
        $post->user_id = Auth::user()->id;

        if(Input::hasFile('img'))
        {
            $thumbnailName = time(). '-thumbnail-post.jpg';

            $thumbnail = Image::make(Input::file('img'));
            $thumbnail->resize(300, 200);
            $thumbnail->save('img/posts/'.$thumbnailName);

            $imageName =time(). '-post.jpg';
            $image = Image::make(Input::file('img'));
            $image->save('img/posts/'.$imageName);

            $post->thumbnail = '/img/posts/'.$thumbnailName;
            $post->img  = '/img/posts/'.$imageName;
        }

        $post->save();

        return Redirect::back()->withFlashMessage('Ditt inlägg har skapats');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return Redirect::back()->withFlashMessage('Inlägget har tagits bort');
    }
}