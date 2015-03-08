<?php
use Family\Forms\ForumCommentForm;
use Family\Forms\ForumGroupValidation;
use Family\Forms\NewThreadForm;
use Illuminate\Routing\Controller;
use Family\Forum\PostThreadCommand;
use Family\Forum\UpdateThreadCommand;
use Family\Forum\PostCommentCommand;

class ForumsController extends BaseController
{

   /* private $forumGroupValidation;

    private $newThreadForm;

    private $forumCommentForm;

    public function __construct(ForumGroupValidation $forumGroupValidation, NewThreadForm $newThreadForm, ForumCommentForm $forumCommentForm)
    {
        $this->forumGroupValidation = $forumGroupValidation;
        $this->newThreadForm = $newThreadForm;
        $this->forumCommentForm = $forumCommentForm;
    }*/

    public function index()
    {
        $groups = ForumGroup::with('categories', 'threads', 'comments', 'user')->get();

        return View::make('forum.index', ['groups' => $groups]);
    }

    public function category($id)
    {
        $category = ForumCategory::find($id);
       if(!Auth::user()->profile->forum_rank <= $category->rank)
        {
            $threads = ForumThread::whereCategory_id($id)->with('comments', 'sticky')->orderBy('updated_at', 'desc')->paginate(20);

            #$threads = ForumThread::with('comments', 'sticky')->whereCategory_id($id)->orderBy('updated_at', 'desc')->paginate(20);
            return View::make('forum.category',compact('threads'),['category' => $category]);
        }
       else
       {
           return Redirect::back()->withFlashMessage('Du har inte tillträde till denna tråd');
       }

    }

    public function storeCategory()
    {
        $input = Input::all();

        #$this->forumGroupValidation->validate($input);

        $category = new ForumCategory;
        $category->title  = Input::get('title');
        if(!Input::get('subtitle') == '')
        {
            $category->subtitle = Input::get('subtitle');
        }
        $category->group_id = Input::get('id');
        $category->author_id = Auth::user()->id;
        $category->rank = Input::get('rank');

        $category->save();

        return Redirect::back()->withFlashMessage('Du har nu lagt till Kategorin "'. $category->title .'"');


    }

    public function deleteCategory($id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            return Redirect::back()->withFlashMessage('Kategorin existerar inte.');
        }
        $threads = $category->threads();
        $comments = $category->comments();

        $thr = true;
        $com = true;

        if($threads->count() > 0)
        {
            $thr = $threads->delete();
        }
        if($comments->count() > 0)
        {
            $com = $comments->delete();
        }
        if($thr && $com && $category->delete())
        {
            return Redirect::to('/forum')->withFlashMessage('Kategorin har tagits bort.');
        }
        else
        {
            return Redirect::to('/forum')->withFlashMessage('Något gick fel.');
        }
    }

    public function thread($id)
    {
        $thread = ForumThread::with('comments', 'locked', 'sticky')->find($id);
        $categories = ForumCategory::all();
        $comments = ForumComment::whereThread_id($id)->paginate(15);
        return View::make('forum.thread', compact('comments'),['thread' => $thread, 'categories' => $categories] );
    }
    public function newThread($id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            return Redirect::back()->withFlashMessage('Kategorin existerar inte.');
        }

        return View::make('forum.newThread', ['category' => $category]);
    }

    public function newThreadStore($id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            return Redirect::back()->withFlashMessage('Det gick inte att skapa tråden. Kategorin har tagits bort.');
        }

        $title = Input::get('title');
        $body = Input::get('body');
        $category_id = $category->id;
        $author_id = Auth::user()->id;
        $group_id = $category->group_id;

        $command = new PostThreadCommand($title, $body, $category_id, $author_id, $group_id);

        $this->CommandBus->execute($command);
        Return Redirect::to('forum/category/'. $category->id);
    }

    public function updateThread($id)
    {
        $thread = ForumThread::find($id);
        if($thread == null)
        {
            return Redirect::to('/forum')->withFlashMessage('Tråden existerar inte!');
        }

        $title = Input::get('title');
        $body = Input::get('body');

        $command = new UpdateThreadCommand($title, $body);

        $this->CommandBus->execute($command);

        return Redirect::to('/forum/thread/'.$thread->id)->withFlashMessage('Tråden har blivit uppdaterad');
    }

    public function lock($id)
    {
        $thread = ForumLocked::whereThread_id($id)->firstOrFail();
        $thread->locked = 1;
        $thread->save();

        return Redirect::back()->withFlashMessage('Du har nu låst en tråd');
    }

    public function unlock($id)
    {
        $thread = ForumLocked::whereThread_id($id)->firstOrFail();
        $thread->locked = 0;
        $thread->save();

        return Redirect::back()->withFlashMessage('Du har nu låst upp en tråd');
    }
    public function editThread($id)
    {
        $thread = ForumThread::find($id);
        if($thread == null)
        {
            return Redirect::back()->withFlashMessage('Tråden kunde inte hittas');
        }
        return View::make('forum.editThread', ['thread' => $thread]);
    }

    public function deleteThread($id)
    {
        $thread = ForumThread::find($id);
        if($thread == null)
        {
            return Redirect::to('/forum')->withFlashMessage('Tråden existerar inte');
        }
        $comments = $thread->comments();

        $delCom = true;

        if($comments->count() > 0)
        {
            $delCom = $comments->delete();
        }
        if($delCom && $thread->delete())
        {
            return Redirect::to('/forum')->withFlashMessage('Tråden har tagits bort');
        }
        return Redirect::to('/forum')->withFlashMessage('Något gick fel');
    }

    public function storeComment($id)
    {
        $thread = ForumThread::find($id);
        if($thread == null)
        {
            return Redirect::back()->withFlashMessage('Tråden existerar inte längre.');
        }

        $body = Input::get('body');
        $author = Auth::user()->id;
        $groupId = $thread->group_id;
        $threadId = $thread->id;
        $categoryId = $thread->category_id;

        $command = new PostCommentCommand($body, $author, $groupId, $threadId, $categoryId);

        $this->CommandBus->execute($command);

        return Redirect::back()->withFlashMessage('Du har nu kommenterat!');

    }

    public function deleteComment($id)
    {
        $comment = ForumComment::find($id);
        if($comment == null)
        {
            return Redirect::back()->withFlashMessage('Kommentaren existerar inte!');
        }
        if($comment->delete())
        {
            return Redirect::back()->withFlashMessage('Kommentaren har tagits bort.');
        }
        else
        {
            return Redirect::back()->withFlashMessage('Något gick fel.');
        }
    }

    public function storeGroup()
    {
        $input = Input::all();
        $this->forumGroupValidation->validate($input);

        $group = new ForumGroup;
        $group->title = Input::get('title');
        $group->author_id = Auth::user()->id;
        $group->rank = Input::get('rank');
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

    public function move($id)
    {
        $input = Input::get('categories');
        $category = ForumCategory::find($input);
        $thread = ForumThread::find($id);
        $comments = ForumComment::whereThread_id($id)->get();

        foreach($comments as $comment)
        {
            $comment->thread_id = $thread->id;
            $comment->category_id = $category->id;
            $comment->group_id = $category->group_id;
            $comment->save();
        }

        $thread->category_id = $category->id;
        $thread->group_id = $category->group_id;
        $thread->save();

        return Redirect::to('/forum/category/'.$category->id)->withFlashMessage('Din tråd har flyttats till '. $category->title);
    }

    public function copy($id)
    {
        $input = Input::get('categories');
        $category = ForumCategory::find($input);
        $oldThread = ForumThread::find($id);

        $newThread = new ForumThread;
        $newThread->title = $oldThread->title;
        $newThread->body = $oldThread->body;
        $newThread->author_id = $oldThread->author_id;
        $newThread->category_id = $category->id;
        $newThread->group_id = $category->group_id;

        $newThread->save();

        $locked = new ForumLocked;
        $locked->locked = false;
        $locked->thread_id = $newThread->id;
        $locked->save();

        $newThread->locked()->save($locked);

        return Redirect::back()->withFlashMessage('DU har nu kopierat tråden '. $oldThread->title. ' till kategorin '. $category->title);

    }

    public function setSticky($id)
    {
        $thread = ForumThread::find($id);

        if($thread == null)
        {
            return Redirect::back()->withFlashMessage('Något gick fel. Trådjäveln finns inte.');
        }

        if($sticky = Sticky::where('forum_thread_id', $id)->first())
        {
            if($sticky->isSticky == 1)
            {
                $sticky->isSticky = 0;
                $sticky->save();
                return Redirect::back()->withFlashMessage('Du har tagit bort nålen för denna tråd.');
            }
            else
            {
                $sticky->isSticky = 1;
                $sticky->save();
                return Redirect::back()->withFlashMessage('Tråden har nu blivit fastnålad');
            }
        }
        else
        {
            $sticky = new Sticky;
            $sticky->forum_thread_id = $thread->id;
            $sticky->isSticky = 1;
            $sticky->save();
            return Redirect::back()->withFlashMessage('Denna tråd är nu fastnålad');
        }


    }
}